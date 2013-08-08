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
	@include('template.global.tuktuk.header')
	@include('template.global.tuktuk.headerbar')
	<section class='bck light padding-bottom'>
		@yield_content('content')
	</section>
	@include('template.global.tuktuk.footer')
	<script type="text/javascript" charset="utf-8">
		$("[data-toggle=popover]").popover({
			trigger: "hover",
			html: true
		});
	</script>
</body>
</html>