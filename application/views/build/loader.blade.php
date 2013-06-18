<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title')</title>
	@include('template.global.scripts')
</head>
<body>
	<h2>Build Loader Testing</h2>
	<code class='results'>
	</code>
	<script type="text/javascript" charset="utf-8">
		$(function() {
			d3up.getBuild(1);
			d3up.getBuild(2);
			console.log(d3up.builds);
		});
	</script>
</body>
</html>