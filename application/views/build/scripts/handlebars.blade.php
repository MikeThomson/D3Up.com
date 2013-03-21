<script type="text/javascript" charset="utf-8">
	Handlebars.registerHelper('round', function(value, places) {
		value = parseFloat(value);
		if(value == 0) {
			return value;
		}
		if(!places) {
			return Math.round(value);
		}
		var exponent = Math.pow(10, places);
		var num = Math.round((value * exponent)).toString();
		return num.slice(0, -1 * places) + "." + num.slice(-1 * places)
	  return Math.round(value * Math.pow());
	});

	Handlebars.registerHelper('percent', function(value, total) {
		return Math.round((value / total) * 10000) / 100
	})

	var sources = [
		'#gear-overview table tbody',
		'#gear-contributions table tbody',
		'#stats-sidebar'
	];

	$.each(sources, function(k,v) {
		var source   = $(v).html();
		var template = Handlebars.compile(source);
		var data = d3up.builds.primary;
		$(v).replaceWith(template(data));		
	});	
</script>
