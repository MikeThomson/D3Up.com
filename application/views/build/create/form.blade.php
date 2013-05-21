{{ Form::open() }}	
	{{ Form::label('name', 'Name') }}
	{{ Form::text('name', Request::get('name'), array('class' => 'input-block-level')) }}
  
	{{ Form::label('class', 'Class') }}
	{{ Form::select('class', D3Up_Classes::$classes, Request::get('class') ?: '', array('class' => 'input-block-level')) }}
  
	{{ Form::label('level', 'Level') }}
	{{ Form::text('level', Request::get('level') ?: 60, array('class' => 'input-block-level')) }}
  
	{{ Form::label('paragon', 'Paragon') }}
	{{ Form::text('paragon', Request::get('paragon') ?: 0, array('class' => 'input-block-level')) }}
  
	{{ Form::label('hardcore', 'Hardcore?') }}
	{{ Form::checkbox('hardcore', false, (Request::get('hardcore') == 'true' ? true : false)) }}

	{{ Form::hidden('character-id', Request::get('character-id') ?: '') }}
	{{ Form::hidden('character-rg', Request::get('character-rg') ?: '') }}
	{{ Form::hidden('character-bt', Request::get('character-bt') ?: '') }}

	<!-- submit button -->
	@if (Session::has('login_errors'))
		<div class="alert alert-error">Email/Username or Password incorrect.</div>
	@endif
	<!-- <div class='btn-group'>
		{{ Form::submit('Create Build', array('class' => 'btn')) }}
	</div> -->
{{ Form::close() }}