<div class="post-navigation d-flex">
  @if(get_adjacent_post(false, '', true))
  <a class="prev" href="{{ get_permalink(get_adjacent_post(false, '', true)->ID) }}">
    « Previous
  </a>
  @endif

  @if(get_adjacent_post(false, '', false))
  <a class="next" href="{{ get_permalink(get_adjacent_post(false, '', false)->ID) }}">
    Next »
  </a>
  @endif
</div>
