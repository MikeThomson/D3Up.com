@layout('template.main')

@section('headerbar')
User Dashboard for {{ $user->username }}
@endsection 

@section('content')
	<div class='row-fluid'>
		<div class='span9 content-page'>
			<div class='btn-group pull-right'>
				<a href="/build/create" class='btn btn-success'>Create a Build</a>
				<a href="/user/edit" class='btn'>Edit Profile</a>
				<a href="/password" class='btn'>Change Password</a>
			</div>
			@include('user.checks')
			<h2>Welcome {{ $user->username }}!</h2>
			<p>This page will be used for quick access to all of your information. It's empty right now however except some user information below.</p>
			<ul>
				<li>Username: "{{ $user->username }}"</li>
				<li>ID: "{{ $user->id }}"</li>
				<li>Email: "{{ $user->email }}"</li>
				<li>BattleTag: "{{ $user->battletag }}"</li>
				<li>Region: "{{ $user->region }}"</li>
			</ul>
		</div>
		<div class='span3 content-page'>
			
		</div>
	</div>
@endsection	