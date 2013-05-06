@layout('template.main')

@section('headerbar')
User Dashboard for {{ $user->username }}
@endsection 

@section('content')
	<div class='row-fluid'>
		<div class='span9 content-page'>
			<div class='btn-group pull-right'>
				<a href="/user/edit" class='btn'>Edit Profile</a>
				<a href="/password" class='btn'>Change Password</a>
			</div>
			@include('user.checks')
			<h2>{{ $user->username }} - {{ $user->email ?: 'No Email Specified' }}</h2>
		</div>
		<div class='span3 content-page'>
			
		</div>
	</div>
@endsection