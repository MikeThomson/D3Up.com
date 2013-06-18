<html>
	<head>
		<title>D3Up Client Test</title>
		<script src="/js/jquery.js"></script>
	</head>
	<body>
		<input type='text' id='d3up-compare-url'>
		<iframe id="d3up-compare"></iframe>
		<script type="text/javascript" charset="utf-8">
			$(function() {
				var url = "/test/client_window",
						params = {
							build: 1,
							data: 'sample'
						}, 
						query = "?";
				$.each(params, function(k,v) { 
					query += "&" + k + "=" + v;
				});
				$("#d3up-compare-url").val(url + query);
				$("#d3up-compare").attr("src", url + query);
			});
		</script>
	</body>
</html>


