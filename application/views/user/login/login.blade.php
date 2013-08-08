<!-- username field -->
{{ Form::label('email', __('login.username_email')) }}
{{ Form::text('email', false, array('class' => 'input-block-level')) }}
<!-- password field -->
{{ Form::label('password', __('login.password')) }}
{{ Form::password('password', array('class' => 'input-block-level')) }}
<!-- submit button -->
@if (Session::has('login_errors'))
	<div class="bck alert padding-5">{{ __('login.failed_login') }}</div>
@endif
<div class='text center margin-top'>
	{{ Form::submit(__('login.login'), array('class' => 'button tiny success')) }} 
	<a href='/register' class='button tiny'>{{ __('login.register') }}</a>
	<a href='/forgot' class='button tiny'>{{ __('login.forgot') }}</a>
</div>