<div class="author d-flex">
  {!! get_avatar(get_the_author_meta('ID', 120)) !!}

  <div class="author-info ml-3">
    <h4 class="name font-weight-normal">
      {{ get_the_author_meta('first_name') }} {{ get_the_author_meta('last_name') }}
    </h4>
    <p>{{ get_the_author_meta('description') }}</p>
  </div>
</div>
