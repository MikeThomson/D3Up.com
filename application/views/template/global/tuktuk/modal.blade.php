<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield_content('title')</title>
	@include('template.global.tuktuk.css')
	@include('template.global.scripts')
</head>
<body>
	@yield_content('content')
</body>
</html>