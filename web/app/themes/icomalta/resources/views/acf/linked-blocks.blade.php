<div class="linked-blocks section">
  @include('acf.partials.block-header')

  @if(have_rows('linked_blocks_repeater'))
    <div class="row no-gutters">
      @while(have_rows('linked_blocks_repeater')) @php the_row() @endphp
      @php $link = get_sub_field('link') @endphp
      <a class="linked-block small d-flex text-center" href="{{ $link['url'] }}" target="{{ $link['target'] }}">
        <div class="align-self-center mx-auto">{!! $link['title'] !!}</div>
      </a>
      @endwhile
      @endif
    </div>
</div>
