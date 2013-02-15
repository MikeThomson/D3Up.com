@layout('template.modal')
@section('content')
{{ Form::open('register', null, array('class' => 'form-signin')) }}
	<h2>Register Account</h2>
	<!-- email field -->
	<p>{{ Form::label('email', 'Email') }}</p>
	<p>{{ Form::text('email', Input::old('email','')) }}</p>
	{{ $errors->has('email') ? '<div class="alert alert-error">Invalid Email Address.</div>' : '' }}
	<!-- password field -->
	<p>{{ Form::label('password', 'Password') }}</p>
	<p>{{ Form::password('password') }}</p>
	{{ $errors->has('password') ? '<div class="alert alert-error">Invalid Password, must be between 8-50 characters.</div>' : '' }}
	<p>{{ Form::label('key', 'Access Key') }}</p>
	<p>{{ Form::text('key') }}</p>
	{{ $errors->has('key') ? '<div class="alert alert-error">Invalid Access Key.</div>' : '' }}
	<!-- submit button -->
	<p>{{ Form::submit('Register', array('class' => 'btn')) }}</p>
{{ Form::close() }}
@endsection