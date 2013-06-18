<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style type="text/css" media="screen">
		body {
			margin: 0;
			padding: 0;
		}
		#modify {
			width: 360px;
			min-height: 200px;
			border: 1px solid #000;
		}
	</style>
</head>
<body>
	<div id="modify">
		
	</div>
	<script src="http://laravel.d3up.com/js/jquery.js"></script>
	<script src="http://laravel.d3up.com/js/jquery-ui-widget.js"></script>
	<script src="http://laravel.d3up.com/js/lodash.js"></script>
	<script src="http://laravel.d3up.com/js/d3up.js"></script>
	<script src="http://laravel.d3up.com/js/game/data.js"></script>
	<script src="http://laravel.d3up.com/js/sandbox.js"></script>
	<script src="http://laravel.d3up.com/js/calc.js"></script>
	<script src="http://laravel.d3up.com/js/utils/build/gear.js"></script>
	<script type="text/javascript" charset="utf-8">
		$(function() {
			d3up.getBuild({{ $id }}).done(function(data) {
				console.log("Build {{ $id }} loaded");
				$('#modify').buildGear({
					calc: new d3up.Calc(data),
					slot: '{{ Input::get('slot', null) }}'
				});
			});
		});
	</script>
</body>
</html>