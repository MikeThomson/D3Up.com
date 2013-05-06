{{ Form::open('register', null, array('class' => 'form-signin')) }}
<div class='pull-left' style="width: 165px">
	<img src="/img/logo.png">
	@include('user.login.disclaimer')
</div>	
<div class='signin'>
	<h2>{{__('login.register_account')}}</h2>
	<!-- username field -->
	<p>{{ Form::label('username', __('login.username')) }}</p>
	<p>{{ Form::text('username', Input::old('username',''), array('class'=>'input-block-level')) }}</p>
	{{ $errors->has('username') ? '<div class="alert alert-error">'.__('login.invalid_username').'</div>' : '' }}
	<!-- email field -->
	<p>{{ Form::label('email', __('login.email')) }}</p>
	<p>{{ Form::text('email', Input::old('email',''), array('class'=>'input-block-level')) }}</p>
	{{ $errors->has('email') ? '<div class="alert alert-error">'.__('login.invalid_email').'</div>' : '' }}
	<!-- password field -->
	<p>{{ Form::label('password', __('login.password')) }}</p>
	<p>{{ Form::password('password', array('class'=>'input-block-level')) }}</p>
	{{ $errors->has('password') ? '<div class="alert alert-error">'.__('login.invalid_password').'</div>' : '' }}
	<p>{{ Form::label('key', 'Access Key') }}</p>
	<p>{{ Form::text('key', '', array('class'=>'input-block-level')) }}</p>
	{{ $errors->has('key') ? '<div class="alert alert-error">Invalid Access Key.</div>' : '' }}
	<!-- submit button -->
	<p>{{ Form::submit(__('login.register'), array('class' => 'btn')) }}</p>
</div>
{{ Form::close() }}