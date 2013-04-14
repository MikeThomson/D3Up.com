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
		@include('template.global.footer')
	</div>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function () {
			$("[data-toggle=popover]").popover({
				// trigger: 'click',
			});
		});
	</script>
</body>
</html>