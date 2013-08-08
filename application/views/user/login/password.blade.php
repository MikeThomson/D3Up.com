{{ Form::open('/password', 'post', array('class' => 'form-signin')) }}
	<a href="/"><img src="/img/logo.png" class='pull-left'></a>
		<!-- username field -->
		{{ Form::label('current', __('login.current_password')) }}
		{{ Form::password('current', array('class' => 'input-block-level')) }}
		{{ $errors->has('current') ? '<div class="alert alert-error">'.__('login.invalid_password_current').'</div>' : '' }}
		<!-- password field -->
		{{ Form::label('password', __('login.password')) }}
		{{ Form::password('password', array('class' => 'input-block-level')) }}
		{{ $errors->has('password') ? '<div class="alert alert-error">'.__('login.invalid_password').'</div>' : '' }}
		<!-- password_confirmation field -->
		{{ Form::label('password_confirmation', __('login.password_again')) }}
		{{ Form::password('password_confirmation', array('class' => 'input-block-level')) }}
		{{ $errors->has('password_confirmation') ? '<div class="alert alert-error">'.$errors->first('password_confirmation').'</div>' : '' }}
		<!-- submit button -->
		@if (Session::has('login_errors'))
			<div class="alert alert-error">{{ __('login.failed_login') }}</div>
		@endif
		{{ Form::submit(__('login.change_password'), array('class' => 'button')) }}
{{ Form::close() }}