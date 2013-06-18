(function($) {
	$.widget( "d3up.buildGear", {
		calc: false, 
		content: false,
		modifying: {},
		modifications: {},
		options: {
			calc: false,
			container: false,
			modifyPane: false,
			gearList: false,
			modifyToggle: false
		},
		_create: function() {
			// Check to see if we have a filter passed in the URL
			var params = this.getParameterByName('filter');
			if(params) {
				// Set the Current State with whatever the URL Parameters are set to
				this.replaceState($.parseJSON($.base64.decode(params)));				
			}
			// Bind the window statechange event to our update method
			this._on(window, { statechange: "update" });
			// Initialize the List
			this._init();
			// Run update immediately to populate default data
			// this.update();
		},
		_init: function() {
			this.calc = this.options.calc;
			var container = this.options.container,
					template = Handlebars.compile(container.html()),
					content = template(this.calc);
			// Setup the Content jQuery Object
			this.content = $(content);
			// Replace the container with our content
			container.replaceWith(this.content);
			// Set the Toggles for Modifying Items
			this._setupModify();
		},
		_toggleModify: function(event) {
			var toggle = $(event.currentTarget),
					slot = toggle.data('modify-toggle');
			// Add the class to the item row indicating the modification
			toggle.closest('tr.item').toggleClass('active-modify');
			// Rotate the Modify Icon 180' 
			toggle.toggleClass("icon-rotate-180");
			// If this item is being modified, remove the modification (we cancelled)
			if(this.modifying[slot]) {
				delete this.modifying[slot];
			} else {
				// Otherwise add it to the objects we're modifying
				this.modifying[slot] = this.calc.build.gear[slot];
				// And create a new modifications object to store the modified values
				this.modifications[slot] = {};
			}
			this._updateModify();
		},
		_setupModify: function() {
			var content = this.content,
					modifyToggles = content.find(this.options.modifyToggle);
			modifyToggles.on('click', $.proxy(this, '_toggleModify'));
		},
		_updateModify: function() {
			// If we don't have modifications occuring, hide and return
			if($.isEmptyObject(this.modifying)) {
				this.options.modify.hide();
				return;
			}
			// Show the mod window
			this.options.modify.show();
			// Set it's height equal to that of the table
			this.options.modify.css({height: $(this.options.gearList).height() + 10});
			// Grab the content into a handlebars template
			var template = Handlebars.compile(this.options.modifyPane.html());
			var content = template(this);
			// Replace the target's HTML with the new handlebars template
			this.options.modify.html(content);
		},
		update: function () {

		},
		getState: function() {
			return History.getState();
		},
		replaceState: function(data) {
			return History.replaceState(data);
		},
		pushState: function(state, name, url) {
			return History.pushState(state, name, "?filter=" + $.base64.encode(JSON.stringify(state)));
		},
		_destroy: function() {
			// Use the destroy method to reverse everything your plugin has applied
			return this._super();
		},
		getParameterByName: function(name, defaultValue) {
			name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
			var regexS = "[\\?&]" + name + "=([^&#]*)";
			var regex = new RegExp(regexS);
			var results = regex.exec(window.location.search);
			if(results == null && defaultValue)
				return defaultValue;
			else if(results == null)
				return null;
			else if(results[1].replace(/\+/g, " ") == "null")
				return null;
			else if(results[1].replace(/\+/g, " ") == "NaN")
				return null;
			else
				return decodeURIComponent(results[1].replace(/\+/g, " "));
		}
	});
})( jQuery );