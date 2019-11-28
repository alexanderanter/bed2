<div class="service-block d-flex{{ isset($boxed) ? ' boxed' : '' }}">
  <div class="service-block--icon mr-2"></div>

  <div class="service-block--inner">
    @if(get_sub_field('heading'))
      <h5 class="service-block--title">{{ get_sub_field('heading') }}</h5>
    @endif
    <div class="service-block--content">{!! get_sub_field('content') !!}</div>
  </div>
</div>
