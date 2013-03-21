Handlebars.registerHelper('prettyStat', function(value, stat) {
	
	var special = {
				decimals: {
					'aps-mh': 4,
					'aps-oh': 4,				
				}, 
				percents: [
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
	if(stat && _.indexOf(special.percents, stat) >= 0) {
		value *= 100;
		append = "%";
	}
	if(typeof(value) == "undefined" || isNaN(value)) {
		value = 0;
	}
	if(value) {
		console.log(stat, value, decimals);
		value = Handlebars.helpers.round.call(this, value, decimals);		
	}
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

Handlebars.registerHelper('if_gt', function(context, options) {
	if (context > options.hash.compare)
		return options.fn(this);
	return options.inverse(this);
});