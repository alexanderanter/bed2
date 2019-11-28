<div class="client-logos">
  <div class="section my-0">
    @include('acf.partials.block-header')

    @if(have_rows('logos_repeater'))
      <div class="row no-gutters">
        @while(have_rows('logos_repeater')) @php the_row() @endphp
        @php $link = get_sub_field('link') @endphp
        @if($link)
          <a rel="nofollow" class="col-lg-3 col-6 logo-block" href="{{ $link['url'] }}" target="{{ $link['target'] }}">
            <img class="img-fluid" src="{{ get_sub_field('image')['sizes']['medium'] }}"
                 alt="{{ get_sub_field('image')['alt'] }}">
          </a>
        @else
          <div class="col-lg-3 col-6 logo-block">
          <img class="img-fluid" src="{{ get_sub_field('image')['sizes']['medium'] }}"
               alt="{{ get_sub_field('image')['alt'] }}">
          </div>
        @endif
        @endwhile
        @endif
      </div>
  </div>
</div>
