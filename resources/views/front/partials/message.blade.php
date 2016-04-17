@if (Session::has('message'))
	<div class="alert {{ Session::get('message.class') }}">
		{{ Session::get('message.detail') }}
	</div>
@endif