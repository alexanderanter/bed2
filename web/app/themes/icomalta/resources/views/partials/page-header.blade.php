<div class="page-header">
  <header class="main-menu">
    <nav>
      @php wp_nav_menu(['menu' => 'main-menu']); @endphp
    </nav>

    <a class="js-menu-toggle" href="#header" title="<?php _e('Open menu', 'novare') ?>">
      <span class="menu-toggle"></span>
    </a>
  </header>

  <div class="container">
    <a class="site-logo" href="<?php echo home_url('/') ?>">
      {!! App::get_site_logo() !!}
    </a>

    <div class="page-header--inner">
      <h1 class="page-header--title">{!! App::title() !!}</h1>
      @include('partials/entry-meta')
      <div class="page-header--content">{!! App::pageHeaderContent() !!}</div>
    </div>
  </div>

  @if($cta = get_field('page_header_cta'))
    <a class="fixed-cta" href="{{ $cta['url'] }}" target="{{ $cta['target'] }}">
      {{ $cta['title'] }}
    </a>
  @endif
</div>
