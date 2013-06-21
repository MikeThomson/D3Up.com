/*
  window.d3up
    builds: object (key = descriptive key: 'default', 'skill-wrath-of-the-berskerer', 'skill-warcry~e')
      skills: object (key = slug of skill name)
        name: json (containing SAME or )
      gear: object (key = slot name)
        slot: json
    calculator
*/

window.d3up = (function() {
	return {
		builds: {
			
		},
		addBuild: function(build, name) {
			if(!name) {
				name = build.id;
			}
			data = new d3up.Calc(build);
			d3up.builds[name] = data;
		},
		getBuild: function(id) { 
			return d3up.builds[id] || (d3up.builds[id] = $.ajax({ 
				url: 'http://api.d3up.com/builds/' + id + '.json', 
				dataType: 'jsonp' 
			}).done(function(buildData) { 
				d3up.builds[id] = new d3up.Calc(buildData); 
			}));
		},
		log: function() { 
			if ( window.console ) { 
				console.log.apply(console, arguments); 
			} 
		}
	};
})();

String.prototype.capitalize = function(){
   return this.replace( /(^|\s)([a-z])/g , function(m,p1,p2){ return p1+p2.toUpperCase(); } );
};

$.fn.delayKeyup = function(callback, ms){
    var timer = 0;
    var el = $(this);
    $(this).keyup(function(){                   
    clearTimeout (timer);
    timer = setTimeout(function(){
        callback(el)
        }, ms);
    });
    return $(this);
};

function difference(template, override) {
    var ret = {};
    for (var name in template) {
        if (name in override) {
            if (_.isObject(override[name]) && !_.isArray(override[name])) {
                var diff = difference(template[name], override[name]);
                if (!_.isEmpty(diff)) {
                    ret[name] = diff;
                }
            } else if (!_.isEqual(template[name], override[name])) {
                ret[name] = override[name];
            }
        }
    }
    return ret;
}
