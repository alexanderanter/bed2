@if(is_single())
<div class="entry-meta tracking text-uppercase">
  <time class="updated" datetime="{{ get_post_time('c', true) }}">{{ get_the_date() }}</time>

  &bullet;

  <span class="byline author vcard">
    {{ __('By', 'sage') }}
    <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" rel="author" class="fn">
      {{ get_the_author() }}
    </a>
  </span>

  &bullet;

  <a href="#comments" class="comments-count">
    @php comments_number() @endphp
  </a>
</div>
@endif
