@if( $config->type == 'textarea' )
	<textarea name="config[{{ $config->name }}]" class="form-control textarea" id="" cols="30" rows="10">{{ $config->value }}</textarea>


@elseif ( $config->type == 'email' )
	<input type="email" name="config[{{ $config->name }}]" class="form-control" value="{{ $config->value }}">

@else
	<input type="text" name="config[{{ $config->name }}]" class="form-control" value="{{ $config->value }}">

@endif
