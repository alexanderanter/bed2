<div class="page-header">
  <header class="main-menu">
    <a class="js-menu-toggle" href="#header" title="<?php _e('Open menu', 'novare') ?>">
      <span class="menu-toggle"></span>
    </a>
  </header>

  <div class="container">
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
