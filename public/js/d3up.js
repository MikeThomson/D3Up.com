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
		builds: {},
		addBuild: function(name, build) {
			this.builds[name] = build;
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

(function($){
  var _priv = {
    cyclicCheck: null,

    diff: function(obj1, obj2)
    {
      if (typeof obj1 === 'undefined')
        obj1 = {};
      if (typeof obj2 === 'undefined')
        obj2 = {};
      
      var val1, val2, mod = {}, add = {}, del = {}, ret;
      $.each(obj2, function(key, val2)
      {
        val1 = obj1[key];
        bDiff = false;
        if (typeof val1 === 'undefined')
          add[key] = val2;
        else if (typeof val1 != typeof val2)
          mod[key] = val2;
        else if (val1 !== val2)
        {
          if (typeof val2 === 'object')
          {
            if ($.inArray(_priv.cyclicCheck, val2) >= 0)
              return false; // break the $.each() loop
            ret = _priv.diff(val1, val2);
            if (!$.isEmptyObject(ret.mod))
              mod[key] = $.extend(true, {}, ret.mod);
            if (!$.isEmptyObject(ret.add))
              add[key] = $.extend(true, {}, ret.add);
            if (!$.isEmptyObject(ret.del))
              del[key] = $.extend(true, {}, ret.del);
            _priv.cyclicCheck.push(val2);
          }
          else
            mod[key] = val2;
        }
      });
      
      $.each(obj1, function(key, val1)
      {
        if (typeof obj2[key] === 'undefined')
          del[key] = true;
      });
      
      return {mod: mod, add: add, del: del};
    }
  };
  
  $.diff = function(obj1, obj2)
  {
    _priv.cyclicCheck = [];
    return _priv.diff(obj1, obj2);
  }
})(jQuery);