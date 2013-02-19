<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title')</title>
	@include('template.global.css')
	@include('template.global.scripts')
</head>
<body>
	<div class="container">
		@include('template.global.header')
		@yield('content')
	</div>
</body>
</html>