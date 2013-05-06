{{ Form::open('/password', 'post', array('class' => 'form-signin')) }}
	<a href="/"><img src="/img/logo.png" class='pull-left'></a>
	<div class='signin'>
		<!-- username field -->
		<p>{{ Form::label('current', __('login.current_password')) }}</p>
		<p>{{ Form::password('current', array('class' => 'input-block-level')) }}</p>
		{{ $errors->has('current') ? '<div class="alert alert-error">'.__('login.invalid_password_current').'</div>' : '' }}
		<!-- password field -->
		<p>{{ Form::label('password', __('login.password')) }}</p>
		<p>{{ Form::password('password', array('class' => 'input-block-level')) }}</p>
		{{ $errors->has('password') ? '<div class="alert alert-error">'.__('login.invalid_password').'</div>' : '' }}
		<!-- password_confirmation field -->
		<p>{{ Form::label('password_confirmation', __('login.password_again')) }}</p>
		<p>{{ Form::password('password_confirmation', array('class' => 'input-block-level')) }}</p>
		{{ $errors->has('password_confirmation') ? '<div class="alert alert-error">'.$errors->first('password_confirmation').'</div>' : '' }}
		<!-- submit button -->
		@if (Session::has('login_errors'))
			<div class="alert alert-error">{{ __('login.failed_login') }}</div>
		@endif
		<div class='btn-group btn-group-block'>
			{{ Form::submit(__('login.change_password'), array('class' => 'btn')) }}
		</div>
	</div>
{{ Form::close() }}