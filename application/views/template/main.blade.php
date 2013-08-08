<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield_content('title')</title>
	@include('template.global.css')
	@include('template.global.scripts')
</head>
<body>
	<div class="container">
		@include('template.global.header')
		<div class='headerbar clearfix'>
			<div class='pull-right notifications'>
				@yield_content('notifications')
				<span class='badge badge-inverse' data-placement='left' data-toggle='popover' data-content="These small bubbles will provide site wide updates, facts, and information about the page you're visiting." data-title="Notifications">?</span>
			</div>
			<h1>@yield_content('headerbar')</h1>
		</div>
		@yield_content('content')
		@include('template.global.footer')
	</div>
	<script type="text/javascript" charset="utf-8">
		$("[data-toggle=popover]").popover({
			trigger: "hover",
			html: true
		});
	</script>
</body>
</html>