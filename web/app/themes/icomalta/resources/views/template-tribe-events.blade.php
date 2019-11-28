{{--
  Template Name: Tribe Events
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.page-events-header')
  @endwhile
	<div class="section mt-0">
		<div class="row">
			<div class="col-md-12 mx-auto">
				<main id="tribe-events-pg-template" class="tribe-events-pg-template">
					@php(tribe_events_before_html())
					@php(tribe_get_view())
					@php(tribe_events_after_html())
				</main> <!-- #tribe-events-pg-template -->
			</div>
		</div>
	</div>
@endsection
