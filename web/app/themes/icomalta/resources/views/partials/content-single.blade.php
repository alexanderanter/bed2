<article @php(post_class())>
  <div class="entry-content">
    @php(the_content())
  </div>
  <footer>
    @include("partials.tags")
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
    @include("partials.author")
    @include("partials.post-navigation")
  </footer>
</article>
