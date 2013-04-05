Handlebars.registerHelper('prettyStat', function(value, stat) {
	var special = {
				decimals: {
					'aps-mh': 4,
					'aps-oh': 4,				
				}, 
				percents: [
					'attack-speed-incs',
					'critical-hit',
					'critical-hit-damage',
					'percent-melee-reduce',
					'percent-elite-reduce',
					'percent-range-reduce',
				],
				x100: [
					'percent-melee-reduce',
					'percent-elite-reduce',
					'percent-range-reduce',				
				]
			},
			decimals = 2,
			prepend = "",
			append = "";
	if(stat && special.decimals[stat]) {
		decimals = special.decimals[stat];
	}
	if(stat && _.indexOf(special.x100, stat) >= 0) {
		value *= 100;
	}
	if(stat && _.indexOf(special.percents, stat) >= 0) {
		append = "%";
	}
	if(typeof(value) == "undefined" || isNaN(value)) {
		value = 0;
	}
	if(value) {
		value = Handlebars.helpers.round.call(this, value, decimals);		
	}
	// Add Commas
	var parts = value.toString().split(".");
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  value = parts.join(".");
	return prepend + value + append;
});
Handlebars.registerHelper('round', function(number, decimal_points) {
	if(typeof(number) == "undefined") {
		return 0;
	}
	if(!decimal_points) {
		return Math.round(number);
	}
	if(number == 0) {
		var decimals = "";
		for(var i=0;i<decimal_points;i++) decimals += "0";
		return "0."+decimals;
	}

	var exponent = Math.pow(10,decimal_points);
	var num = Math.round((number * exponent)).toString();
	return parseFloat(num.slice(0,-1*decimal_points) + "." + num.slice(-1*decimal_points));
});

Handlebars.registerHelper('percent', function(value, total) {
	return Math.round((value / total) * 10000) / 100
});

Handlebars.registerHelper('heatmap', function(stat, value, total) {
	var color = {
		r: 255,
		g: 255,
		b: 255
	};
	var min = 0.5,
			percent = Math.round((value / total) * 10000) / 10000 * 10;
	if(percent < 0.7) {
		percent = 0.7;
	}
	switch(stat) {
		case "ehp":
			color.r = 0;
			color.b = 0;
			color.g = Math.round(255 * percent);
			break;
		case "dps":
			color.g = 0;
			color.b = 0;
			color.r = Math.round(255 * percent);
			break;
	}
	return "color: rgba(" + color.r + "," + color.g + "," + color.b + ", 1)";
});

Handlebars.registerHelper('if_gt', function(context, options) {
	if (context > options.hash.compare)
		return options.fn(this);
	return options.inverse(this);
});

Handlebars.registerHelper('skillName', function(name) {
	return name.split("~")[0];
});
