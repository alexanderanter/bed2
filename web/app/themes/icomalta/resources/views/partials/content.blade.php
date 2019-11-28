@php
  $cat = get_the_category();
@endphp

<article @php(post_class('col-md-6'))>
  <header>
    <a href="{{ get_the_permalink() }}">
      @php the_post_thumbnail('medium', ['class' => 'img-fluid w-100']) @endphp
    </a>
    <a href="{{ get_category_link($cat[0]->term_id) }}" class="category">
      {{ $cat[0]->name }}
    </a>
  </header>
  <div class="article-inner">
    <h2 class="h5 entry-title"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h2>
    @php(the_excerpt())
    <time class="updated tracking" datetime="{{ get_post_time('c', true) }}">{{ get_the_date() }}</time>
  </div>
</article>
