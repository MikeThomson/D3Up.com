<!-- username field -->
<p>{{ Form::label('email', __('login.email')) }}</p>
<p>{{ Form::text('email', false, array('class' => 'input-block-level')) }}</p>
<!-- password field -->
<p>{{ Form::label('password', __('login.password')) }}</p>
<p>{{ Form::password('password', array('class' => 'input-block-level')) }}</p>
<!-- submit button -->
@if (Session::has('login_errors'))
	<div class="alert alert-error">{{ __('login.failed_login') }}</div>
@endif
<div class='btn-group'>
	{{ Form::submit(__('login.login'), array('class' => 'btn')) }}
	<a href='/register' class='btn'>{{ __('login.register') }}</a>
</div>