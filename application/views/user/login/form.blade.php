{{ Form::open('/login', 'post', array('class' => 'form-signin')) }}
	<img src="/img/logo.png" class='pull-left'>
	<div class='signin'>
		@include('user.login.login')
	</div>
	@include('user.login.disclaimer')
{{ Form::close() }}