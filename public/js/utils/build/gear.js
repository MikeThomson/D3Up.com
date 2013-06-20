(function($) {
	$.widget( "d3up.buildGear", {
		options: {
			calc: false,
			container: false,
			modifyPane: false,
			displayItems: false,
			gearList: false,
			modifyToggle: false
		},
		_create: function() {
			// Load up our Calc
			var calc = this.calc = this.options.calc;
			// Create an empty elements object
			this.elements = {};
			// Create an empty modifying ojbect
			this.modifying = {};
		},
		_log: function(msg) {
			console.log("d3up.buildGear @ ", msg);
		},
		_init: function() {
			this._log("_init");

			var container = this.options.container,
					template = Handlebars.compile(container.html()),
					content = template(this.calc),
					$content = this.elements.content = $(content);
			// Replace the container with our handlebars content
			container.replaceWith($content);
			// Create all of our bindings on controls
			this._addBindings();
		},
		_addBindings: function() {
			this._log("_addBindings");			
			var el = this.elements.content;
			el.on('click', this.options.modifyToggle, $.proxy(this, '_modifyToggle'));
		},
		_modifyToggle: function(event) {
			this._log("_modifyToggle");
			var toggle = $(event.currentTarget),
					slot = toggle.data('modify-toggle');
			// Add the class to the item row indicating the modification
			toggle.closest('tr.item').toggleClass('active-modify');
			// Rotate the Modify Icon to point the other way
			toggle.toggleClass("icon-flip-horizontal");
			// If this item is being modified, remove the modification (we cancelled)
			if(this._modifyIs(slot)) {
				this._modifyEnd(slot);
			} else {
				this._modifyStart(slot);
			}
		},
		_modifyIs: function(slot) {
			this._log("_modifyIs");
			return (this.modifying[slot]);
		},
		_modifyStart: function(slot) {
			this._log("_modifyStart @ " + slot);
			// Add the item into our modifying object, false for uninitialized builder
			this.modifying[slot] = false;
			// Update our modification panel
			this._modifyUpdate();
			this._log("_modifyStart @ Currently: " + JSON.stringify(this.modifying));
		},
		_modifyEnd: function(slot) {
			this._log("_modifyEnd @ " + slot);
			// Find the element in the mod bar
			var item = this.options.modify.find("[data-slot=" + slot + "]");
			// Remove the item from our modifying object
			delete this.modifying[slot];			
			// Destroy the item & builder
			item.remove();
			// Update our modification panel
			this._modifyUpdate();
			this._log("_modifyEnd @ Currently: " + JSON.stringify(this.modifying));
		},
		_modifyUpdate: function() {
			// If we don't have modifications occuring, hide and return
			if($.isEmptyObject(this.modifying)) {
				this._log("_modifyUpdate @ hiding, no modifications");
				this.options.modify.hide();
				return;
			}
			this._log("_modifyUpdate @ displaying");
			var $this = this,
					calc = this.calc,
					modify = this.options.modify,
					content = this.elements.content,
					displays = this.options.displayItems;
			// Show the mod window
			modify.show();
			// Set it's height equal to that of the content
			modify.css({height: $(content).height() + 10});
			_.each(this.modifying, function(data, slot) {
				var search = "[data-slot=" + slot + "]",
						display = displays.find(search).clone();
				// If we haven't initalized an item builder for this, do it
				if(data === false) {
					// Create the itemBuilder on the element
					display.itemBuilder({
						item: calc.build.gear[slot],
						modding: true,
						// onSave: function() {
						// 	$this._modifyEnd(slot)
						// }
						onCancel: function() {
							$this._modifyEnd(slot)
						}
					});
					// Append the Item Builder
					modify.append(display);			
					// Save that we're initialized with a builder		
					this.modifying[slot] = true;
				}
			}, this);
			
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