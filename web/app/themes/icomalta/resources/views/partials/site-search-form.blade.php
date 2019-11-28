<form method="get" class="search-form" action="{{ home_url('/') }}">
  <input type="text" class="form-control" name="s" id="s" placeholder="{{ __( 'Search', 'icomalta' ) }}" value="{{ get_query_var('s') }}" />
  <button class="search-submit" title="{{ __( 'Search', 'icomalta' ) }}" type="submit">x</button>
</form>
