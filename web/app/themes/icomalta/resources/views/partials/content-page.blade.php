@if(!empty(get_the_content()))
<div class="section mt-0">
	<div class="row">
		<div class="col-md-10 mx-auto">
			@php(the_content())
		</div>
	</div>
</div>
@endif

@include("partials.flexible-content")
