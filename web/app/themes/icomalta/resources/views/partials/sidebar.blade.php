@php($global_blocks = \App\GlobalBlocks::get())
@if($global_blocks)
  @while($global_blocks->have_posts()) @php($global_blocks->the_post())
  @include("partials.global-block")
  @endwhile @php(wp_reset_postdata())
@endif

<aside class="sidebar">
  @php(dynamic_sidebar('sidebar-primary'))
</aside>
