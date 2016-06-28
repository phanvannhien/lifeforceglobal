@if (Session::has('message'))
	<div class="alert {{ Session::get('message.class') }}">
		{{ Session::get('message.detail') }}
	</div>
@endif

@if ( isset($message))
	<div class="alert {{ $message['class'] }}">
		{{ $message['detail'] }}
	</div>
@endif
<?php var_dump($errors)?>

@if (count($errors) > 0)

	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif	