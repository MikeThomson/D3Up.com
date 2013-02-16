{{ Form::open('login', 'test', array('class' => 'form-signin')) }}
	<!-- username field -->
	<p>{{ Form::label('email', 'Email/Username') }}</p>
	<p>{{ Form::text('email', false, array('class' => 'input-block-level')) }}</p>
	<!-- password field -->
	<p>{{ Form::label('password', 'Password') }}</p>
	<p>{{ Form::password('password', array('class' => 'input-block-level')) }}</p>
	<!-- submit button -->
	@if (Session::has('login_errors'))
		<div class="alert alert-error">Email/Username or Password incorrect.</div>
	@endif
	<div class='btn-group'>
		{{ Form::submit('Login', array('class' => 'btn')) }}
		<a href='/register' class='btn'>Register</a>
	</div>
{{ Form::close() }}