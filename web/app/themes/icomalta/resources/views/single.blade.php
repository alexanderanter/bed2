@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
  @include('partials.page-header')

  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        @include('partials.content-single-'.get_post_type())
      </div>
      <div class="col-lg-4 blog-sidebar">
        @include("partials.sidebar")
      </div>
    </div>
  </div>

  <div class="comments-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          @php(comments_template('/partials/comments.blade.php'))
        </div>
      </div>
    </div>
  </div>
  @endwhile
@endsection
