@php($boxed = get_sub_field('boxed'))

<div class="feature-blocks section">
  <div class="row">
    @while(have_rows('two_column_repeater')) @php the_row() @endphp
    <div class="feature-block col-lg-6 d-flex{{ isset($boxed) ? ' boxed' : '' }}">
      @if(get_sub_field('icon'))
        <div class="feature-block--icon mr-2 mt-1">
          <img src="{{ get_sub_field('icon')['url'] }}" alt="{{ get_sub_field('icon')['alt'] }}">
        </div>
      @endif

      <div class="feature-block--inner">
        @if(get_sub_field('heading'))
          <h3 class="feature-block--title">{{ get_sub_field('heading') }}</h3>
        @endif
        <div class="feature-block--content">{!! get_sub_field('content') !!}</div>
      </div>
    </div>
    @endwhile
  </div>
</div>
