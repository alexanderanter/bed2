@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  <div class="section mt-5 px-lg-5">
    <div class="row">
      <div class="col-lg-8">
        @if (!have_posts())
          <div class="alert alert-warning">
            {{ __('Sorry, no results were found.', 'sage') }}
          </div>
          {!! get_search_form(false) !!}
        @endif

        <div class="row">
          @while (have_posts()) @php(the_post())
          @include('partials.content-'.get_post_type())
          @endwhile
        </div>

        {!! App::pagination() !!}
      </div>

      <div class="col-lg-4 blog-sidebar">
        @include("partials.sidebar")
      </div>
    </div>
  </div>
@endsection
