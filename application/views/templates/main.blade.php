<!DOCTYPE HTML>
<html lang="en-GB">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	{{ HTML::style('css/style.css') }}
</head>
<body>
	<div class="header">
		@if ( Auth::guest() )
			{{ HTML::link('admin', 'Login') }}
		@else
			{{ HTML::link('logout', 'Logout') }}
		@endif
		<hr />
		<h2>D3Up Laravel Testing</h2>
	</div>
	<div class="content">
		@yield('content')
	</div>
</body>
</html>