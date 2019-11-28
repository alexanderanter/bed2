<div class="text-block section{{ (get_sub_field('section_border_bottom') ? ' section-border-bottom' : '') }}">
  <div class="row">
    <div class="col-md-10{{ (get_sub_field('center_block') ? ' mx-auto' : '') }}">
      @if(get_sub_field('title'))
      <h2 class="text-block--title">
        {{ get_sub_field('title') }}
      </h2>
      @endif

      <div class="text-block--content">
        {!! get_sub_field('text') !!}
      </div>
    </div>
  </div>
</div>
