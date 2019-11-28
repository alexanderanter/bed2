<?php
/**
 *
 * @package   WPBruiser
 * @author    Mihai Chelaru
 * @link      http://www.wpbruiser.com
 * @copyright 2015 Mihai Chelaru
 *
 * @wordpress-plugin
 * Plugin Name: WPBruiser - ContactForm7
 * Plugin URI: http://www.wpbruiser.com
 * Description: WPBruiser - ContactForm7 extension.
 * Version: 3.0.9
 * Author: Mihai Chelaru
 * Author URI: http://www.wpbruiser.com
 * Text Domain: goodbye-captcha
 * License: GPL-2.0+
 * Domain Path: /languages
 */
final class WPBruiserContactForm7
{
	CONST MODULE_VERSION    = '3.0.9';
	protected function __construct()
	{}

	public static function getInstance()
	{
		static $instance = null;
		return (null !== $instance) ? $instance : $instance = new self();
	}
}

add_action('plugins_loaded', array( 'WPBruiserContactForm7', 'getInstance' ), 20);
