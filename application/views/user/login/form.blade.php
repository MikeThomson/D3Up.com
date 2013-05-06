{{ Form::open('/login', 'post', array('class' => 'form-signin')) }}
	<a href="/"><img src="/img/logo.png" class='pull-left'></a>
	<div class='signin'>
		@include('user.login.login')
	</div>
{{ Form::close() }}