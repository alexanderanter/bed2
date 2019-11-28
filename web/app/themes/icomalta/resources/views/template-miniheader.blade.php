{{--
  Template Name: Miniheader
--}}

@extends('layouts.miniheader')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.page-miniheader-header')
    @include('partials.content-page')
  @endwhile
@endsection
