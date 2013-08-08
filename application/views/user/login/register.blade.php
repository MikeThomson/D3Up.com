{{ Form::open('register', null, array('class' => 'form-signin')) }}
	<h2 class='margin-top margin-bottom'>{{__('login.register_account')}}</h2>
	<!-- username field -->
	{{ Form::label('username', __('login.username')) }}
	{{ Form::text('username', Input::old('username',''), array('class'=>'input-block-level')) }}
	{{ $errors->has('username') ? '<div class="bck alert padding-5">'.__('login.invalid_username').'</div>' : '' }}
	<!-- email field -->
	{{ Form::label('email', __('login.email')) }}
	{{ Form::text('email', Input::old('email',''), array('class'=>'input-block-level')) }}
	{{ $errors->has('email') ? '<div class="bck alert padding-5">'.__('login.invalid_email').'</div>' : '' }}
	<!-- password field -->
	{{ Form::label('password', __('login.password')) }}
	{{ Form::password('password', array('class'=>'input-block-level')) }}
	{{ $errors->has('password') ? '<div class="bck alert padding-5">'.__('login.invalid_password').'</div>' : '' }}
	{{ Form::label('key', 'Access Key') }}
	{{ Form::text('key', '', array('class'=>'input-block-level')) }}
	{{ $errors->has('key') ? '<div class="bck alert padding-5">Invalid Access Key.</div>' : '' }}
	<div class='text center margin-top margin-bottom'>
		<!-- submit button -->
		{{ Form::submit(__('login.register'), array('class' => 'button')) }}
	</div>
{{ Form::close() }}