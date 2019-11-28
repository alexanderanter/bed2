<footer class="footer content-info">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 order-lg-2">
        <div class="row">
          @php(dynamic_sidebar('sidebar-footer'))
        </div>
      </div>
      <div class="col-lg-6 order-lg-1 d-flex flex-column">
        @if(have_rows('footer_icons', 'option'))
        <div class="social-links d-flex flex-row">
          @while(have_rows('footer_icons', 'option')) @php(the_row())
          <a class="d-block mr-3" href="{{ get_sub_field('link')['url'] }}" target="{{ get_sub_field('link')['target'] }}">
            <img src="{{ get_sub_field('image')['url'] }}" alt="{{ get_sub_field('image')['alt'] }}">
          </a>
          @endwhile
        </div>
        @endif
        <p class="mt-auto small">
          <img class="align-baseline mr-1" src="{{ get_field('logo_icon', 'option')['url'] }}" alt="Logo icon" width="25">
          <i>© {{ date('Y') }} {{ get_field('footer_copyright_text', 'option') }}</i>
        </p>
      </div>
    </div>
  </div>
</footer>
