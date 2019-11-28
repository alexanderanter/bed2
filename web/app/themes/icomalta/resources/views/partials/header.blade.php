<header class="d-flex main-menu" id="header">
  <a class="site-logo" href="<?php echo home_url('/') ?>">
    <img class="img-fluid" src="@asset('images/logo-icon.svg')" alt="Logo">
  </a>

  <nav class="align-items-lg-center d-flex">
    @php wp_nav_menu(['menu' => 'main-menu']); @endphp
  </nav>

  <a class="js-menu-toggle" href="#header" title="<?php _e('Open menu', 'novare') ?>">
    <span class="menu-toggle"></span>
  </a>
</header>
