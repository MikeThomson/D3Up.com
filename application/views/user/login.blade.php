@layout('template.modal')
@section('content')
{{ Form::open('login', 'test', array('class' => 'form-signin')) }}
	<h2>Login</h2>
	<!-- username field -->
	<p>{{ Form::label('email', 'Email') }}</p>
	<p>{{ Form::text('email') }}</p>
	<!-- password field -->
	<p>{{ Form::label('password', 'Password') }}</p>
	<p>{{ Form::password('password') }}</p>
	<!-- submit button -->
	@if (Session::has('login_errors'))
		<div class="alert alert-error">Email or password incorrect.</div>
	@endif
	<p>
		{{ Form::submit('Login', array('class' => 'btn')) }}
		<a href='/register' class='btn'>Register</a>
	</p>
{{ Form::close() }}
@endsection