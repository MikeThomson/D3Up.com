<div class='bck rounded padding margin'>
	{{ Form::open('/login', 'post') }}
		@include('user.login.login')
	{{ Form::close() }}
</div>
