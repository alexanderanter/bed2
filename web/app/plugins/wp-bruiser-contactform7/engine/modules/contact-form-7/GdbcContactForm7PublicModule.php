<?php

/*
 * Copyright (C) 2014 Mihai Chelaru
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

final class GdbcContactForm7PublicModule extends GdbcBasePublicModule
{

	protected function __construct()
	{
		parent::__construct();


		if(!GoodByeCaptchaUtils::isContactForm7Activated() || (!$this->getOption(GdbcContactForm7AdminModule::OPTION_IS_CONTACT_FORM_7_ACTIVATED)))
			return;

		$this->registerContactForm7Hooks();

	}

	private function registerContactForm7Hooks()
	{

		add_filter('wpcf7_form_elements', array($this, 'appendHiddenFieldIntoForm'), 10, 1);
		add_filter('wpcf7_spam'         , array($this, 'validateContactForm7EncryptedToken'), 9);

		add_filter( 'wpcf7_posted_data', array($this, 'capturePostedData'), 999);

	}

	public function capturePostedData($arrPostedData)
	{

		$arrAdditionalData  = array();
		$currentContactForm = function_exists('wpcf7_get_current_contact_form') ? wpcf7_get_current_contact_form() : null;

		if(!empty($currentContactForm)){
			$arrAdditionalData['form-title'] = method_exists($currentContactForm, 'title') ? $currentContactForm->title() : null;
		}

		$arrAdditionalData['page-url']   = function_exists('wpcf7_get_request_uri') ? preg_replace( '%(?<!:|/)/.*$%', '', untrailingslashit( home_url() ) ) . wpcf7_get_request_uri() : null;

		$arrPostedData = array_merge($arrAdditionalData, array_filter((array)$arrPostedData));

		foreach($arrPostedData  as $index => $value)
		{
			if( false !== strpos($index, '_wpcf7') ) {
				unset($arrPostedData[$index]);
			}
		}

		//print_r($arrPostedData);exit;

		$this->setSubmittedData($arrPostedData);

		return $arrPostedData;
	}

	public function validateContactForm7EncryptedToken()
	{
		$this->getAttemptEntity()->Notes = $this->getSubmittedData();
		return !GdbcRequestController::isValid($this->getAttemptEntity());
	}

	public function appendHiddenFieldIntoForm($stringHtml = null)
	{
		return $this->getTokenFieldHtml() . $stringHtml;
	}

	/**
	 * @return int
	 */
	protected function getModuleId()
	{
		return GdbcModulesController::getModuleIdByName(GdbcModulesController::MODULE_CONTACT_FORM_7);
	}

	public static function getInstance()
	{
		static $adminInstance = null;
		return null !== $adminInstance ? $adminInstance : $adminInstance = new self();
	}


}