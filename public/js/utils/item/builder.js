(function($) {
	$.widget( "d3up.itemBuilder", {
		ignored: ['min-damage', 'max-damage', 'plus-damage', 'plus-aps'],
		ranges: ['damage', 'block-amount'],
		_create: function() {
			console.log("_create");
		},
		_addToggle: function() {
			var bottom = this.elements.bottom,
					modify = this.elements.modify;
			bottom.append(modify);
		},
		_addBindings: function() {
			var editor = this.elements.editor,
					bottom = this.elements.bottom;
			// Item Editor Bindings
			editor.on('change', '[data-type]', $.proxy(this, '_modifyType'));
			editor.on('keyup', '[data-attr]', $.proxy(this, '_modifyAttr'));
			editor.on('keyup', '[data-stat]', $.proxy(this, '_modifyStat'));
			editor.on('click keypress', '[data-for=attr-add]', $.proxy(this, '_addAttrFinder'));
			// Bottom Control Bindings
			bottom.on('click keypress', '[data-for=modify]', $.proxy(this, '_togglePane'));
			bottom.on('click keypress', '[data-for=save]', $.proxy(this, '_save'));
			bottom.on('click keypress', '[data-for=revert]', $.proxy(this, '_revert'));
			bottom.on('click keypress', '[data-for=cancel]', $.proxy(this, '_togglePane'));
			
		},
		_addAttrFinder: function() {
			var $this = this,
					attrs = this.elements.attrs,
					li = $("<li>"),
					search = $("<input type='text' class='input-block-level'>");
			search.attr("placeholder", "Start typing the name and press enter");
			search.typeahead({
				source: _.values(d3up.gameData.attributes),
				updater: function(item) {
					var inverse = _.invert(d3up.gameData.attributes);
					li.replaceWith($this._createPaneAttr(inverse[item], 1));
					attrs.find("[data-attr='" + inverse[item] + "'] input").focus();
				}
			});
			attrs.find('li:last').prev().after(li.append(search));
			li.find("input").focus().select();
		},
		_modifyType: function(event) {
			console.log("_modifyType");
			var modified = this.options.modified,
					target = $(event.currentTarget),
					key = target.data("type"),
					value = target.val();
			if(key === 'quality') {
				modified[key] = Number(value);
			} else if(key === 'type') {
				modified[key] = value;				
			}
			this._update();
			console.log(JSON.stringify(modified));			
		},
		_modifyStat: function(event) {
			console.log("_modifyStat");
			var modified = this.options.modified,
					target = $(event.currentTarget),
					stat = target.data("stat"),
					value = target.val();
			if(!modified.stats) {
				modified.stats = {};
			}
			modified.stats[stat] = Number(value);
			this._update();
			console.log(JSON.stringify(modified));
		},
		_modifyAttr: function(event) {
			console.log("_modifyAttr");
			var modified = this.options.modified,
					target = $(event.currentTarget),
					input = target.find("input"),
					attr = target.data("attr"),
					value = input.val();
			if(!modified.attrs) {
				modified.attrs = {};
			}
			modified.attrs[attr] = Number(value);
			this._update();
			console.log(JSON.stringify(modified));
		},
		_togglePane: function() {
			// Hide the actual Item display
			this.elements.item.toggle();
			// Hide the Toggle 
			this.elements.modify.toggle();
			// Hide the actual Item display
			this.elements.editor.toggle();
			// Hide the Toggle 
			this.elements.controls.toggle();
		},
		_createPane: function() {
			console.log("_createPane");
			var editor = this.elements.editor = $("<div class='item item-editor well-small'>"),
					controls = this.elements.controls = $("<div class='bottom btn-group'>");
			// Quickly add some buttons
			controls.append($("<a class='btn' href='#' data-for='save'>Save</a>"));
			controls.append($("<a class='btn' href='#' data-for='revert'>Revert</a>"));
			controls.append($("<a class='btn' href='#' data-for='cancel'>Cancel</a>"));
			editor.append(this.elements.item.find(".item-icon").clone());
			// Hide the Editor & Controls
			editor.hide();
			controls.hide();
			// Append the Editor after the actual Item
			this.elements.item.after(editor);
			// Append the new Controls
			this.elements.bottom.append(controls);
			// Add the Item Types
			this._createPaneTypes();
			// Add the Stats Options
			this._createPaneStats();
			// Add the Attribute Options
			this._createPaneAttrs();
		},
		_createPaneTypes: function() {
			console.log("_createPaneTypes");
			var item = this.options.item,
					editor = this.elements.editor,
					types = d3up.gameData.types,
					qualities = d3up.gameData.qualities,
					type = $("<select data-type='type'>"),
					quality = $("<select data-type='quality'>");
			_.each(types, function(display, key) {
				var li = $("<option>");
				li.attr("value", key);
				li.html(display);
				if(item.type === key) {
					li.attr("selected", "selected");
				}
				type.append(li);
			}, this);
			_.each(qualities, function(display, key) {
				var li = $("<option>");
				li.attr("value", key);
				li.html(display);
				console.log(item.quality);
				if(String(item.quality) === key) {
					li.attr("selected", "selected");
				}
				quality.append(li);
			}, this);
			editor.append($("<div>").append(quality, type));
		},
		_createPaneStats: function() {
			console.log("_createPaneStats");
			var item = this.options.item,
					editor = this.elements.editor;
			_.each(item.stats, function(value, stat) {
				var input = $("<input type='text'>"),
						container = $("<div>"),
						text = d3up.gameData.stats[stat];
				if(_.indexOf(this.ranges, stat) >= 0) {
					var input1 = input.clone(),
							input2 = input.clone(),
							container1 = container.clone().html("Min " + text),
							container2 = container.clone().html("Max " + text);
					console.log("this is a range: ", stat);
					input1.val(value['min'])
						.addClass("range")
						.attr('data-stat', stat + '~min');
					input2.val(value['max'])
						.addClass("range")
						.attr('data-stat', stat + '~max');
					editor.append(container1.prepend(input1), container2.prepend(input2));
				} else {
					input.val(value)
						.attr("data-stat", stat);
					editor.append(container.html(text).prepend(input));
				}
			}, this);
		},
		_createPaneAttr: function(attr, value) {
			console.log("_createPaneAttr", attr, value);
			var li = $("<li>"),
					text = d3up.gameData.attributes[attr],
					input = "<input type='text' value='" + value + "'>";
			text = text.replace(/\[X\]/g, input);
			li.attr('data-attr', attr).html(text);
			return li;
		},
		_createPaneAttrs: function() {
			console.log("_createPaneAttrs");
			var item = this.options.item,
					editor = this.elements.editor,
					attrs = this.elements.attrs = $("<ul class='attrs'>");
			_.each(item.attrs, function(value, attr) {
				attrs.append(this._createPaneAttr(attr, value));
			}, this);
			attrs.append($("<li><a class='btn btn-mini' href='#' data-for='attr-add'>Add Attribute</a></li>"));
			editor.append(attrs);
		},
		_removePane: function() {
			console.log("_removePane");
			this.elements.editor.remove();
			this.elements.controls.remove();
			this.elements.item.show();
			this.elements.modify.show();
		},
		_revert: function() {
			console.log("_revert");
			var $this = this;
			$.each(this.element.find("[data-modify]"), function() {
				console.log("reverting " + $(this).data("modify"));
				var attr = $(this).data("modify");
				$(this).val($this.originals[attr]);				
			});
			// Reset the Modified attributes
			this.options.modified = {};
		},
		_save: function() {
			console.log("_save");
			if($.isEmptyObject(this.options.modified)) {
				console.log("not saving, no changes");
			} else {
				$.ajax({
					url: '/i/' + this.options.item.id + '/edit',
					type: 'POST',
					data: this.options.modified
				}).done(this.options.onSave);
				console.log("saving");				
			}
			console.log(this.options.modified);
		},
		_update: function() {
			console.log("_update");
			var callback = this.options.callback;
			if(callback) {
				callback(this.options.modified);
			}
		},
		_init: function() {
			console.log("_init");
			// Assign some initial elements
			this.elements = {
				item: this.element.find(".item"),
				top: this.element.find(".top"),
				bottom: this.element.find(".bottom"),
				modify: $("<a class='btn' data-for='modify'>Modify</a>")
			};
			// Make sure our modified object exists
			if(!this.options.modified) {
				this.options.modified = {};
			}
			// Create our Toggle
			this._addToggle();
			// Create our Edit Pane
			this._createPane();
			// Add Bindings to all buttons
			this._addBindings();
		}
	});
})( jQuery );
