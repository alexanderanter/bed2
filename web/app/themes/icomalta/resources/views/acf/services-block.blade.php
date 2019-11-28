@php
$repeater = have_rows('services_repeater');

@endphp

<div class="services-blocks section">
  @include('acf.partials.block-header')
  <div class="row">
    <div class="col-md-4">
      @while(have_rows('services_repeater_left')) @php the_row() @endphp
      @include("acf.partials.services-block")
      @endwhile
    </div>

    <div class="col-md-4 px-0">
      <?php if( $post->ID == 40) { ?>
        <img class="img-fluid" src="https://icomalta.com/app/uploads/2018/12/2iphone.png')" alt="ICO plattform">
    <?php }else { ?>
        <img class="img-fluid" src="@asset('images/networkcircle.jpg')" alt="Network Circle">
    <?php  } ?>

    </div>

    <div class="col-md-4">
      @while(have_rows('services_repeater_right')) @php the_row() @endphp
      @include("acf.partials.services-block")
      @endwhile
    </div>
  </div>
</div>
