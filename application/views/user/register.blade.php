@layout('template.modal')
@section('content')
{{ Form::open('register', null, array('class' => 'form-signin')) }}
	<h2>{{__('login.register_account')}}</h2>
	<!-- email field -->
	<p>{{ Form::label('email', __('login.email')) }}</p>
	<p>{{ Form::text('email', Input::old('email','')) }}</p>
	{{ $errors->has('email') ? '<div class="alert alert-error">'.__('login.invalid_email').'</div>' : '' }}
	<!-- password field -->
	<p>{{ Form::label('password', __('login.password')) }}</p>
	<p>{{ Form::password('password') }}</p>
	{{ $errors->has('password') ? '<div class="alert alert-error">'.__('login.invalid_password').'</div>' : '' }}
	<p>{{ Form::label('key', 'Access Key') }}</p>
	<p>{{ Form::text('key') }}</p>
	{{ $errors->has('key') ? '<div class="alert alert-error">Invalid Access Key.</div>' : '' }}
	<!-- submit button -->
	<p>{{ Form::submit(__('login.register'), array('class' => 'btn')) }}</p>
{{ Form::close() }}
@endsection