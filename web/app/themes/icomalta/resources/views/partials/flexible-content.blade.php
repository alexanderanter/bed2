@if(have_rows('flexible_content'))
<div class="flexible-content">
  @while ( the_flexible_field('flexible_content') )
    @include('acf/'. get_row_layout() )
  @endwhile
</div>
@endif
