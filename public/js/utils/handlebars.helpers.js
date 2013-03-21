Handlebars.registerHelper('round', function(number,decimal_points) {
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