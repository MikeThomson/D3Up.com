{{ Form::open('build/create', 'POST', array('class' => 'form-signin')) }}	
	<h3>Build Information Form</h3>

	<p>{{ Form::label('name', 'Name') }}</p>
	<p>{{ Form::text('name', Request::get('name') ?: '', array('class' => 'input-block-level')) }}</p>

	<p>{{ Form::label('class', 'Class') }}</p>
	<p>{{ Form::select('class', D3Up_Classes::$classes, Request::get('class') ?: '', array('class' => 'input-block-level')) }}</p>

	<p>{{ Form::label('level', 'Level') }}</p>
	<p>{{ Form::text('level', Request::get('level') ?: 60, array('class' => 'input-block-level')) }}</p>

	<p>{{ Form::label('paragon', 'Paragon') }}</p>
	<p>{{ Form::text('paragon', Request::get('paragon') ?: 0, array('class' => 'input-block-level')) }}</p>

	<p>{{ Form::label('hardcore', 'Hardcore?') }}</p>
	<p>{{ Form::checkbox('hardcore', false, (Request::get('hardcore') == 'true' ? true : false)) }}</p>

	{{ Form::hidden('character-id', Request::get('character-id') ?: '') }}
	{{ Form::hidden('character-rg', Request::get('character-rg') ?: '') }}
	{{ Form::hidden('character-bt', Request::get('character-bt') ?: '') }}

	<!-- submit button -->
	@if (Session::has('login_errors'))
		<div class="alert alert-error">Email/Username or Password incorrect.</div>
	@endif
	<div class='btn-group'>
		{{ Form::submit('Create Build', array('class' => 'btn')) }}
	</div>
{{ Form::close() }}