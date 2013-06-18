(function($) {
	$.widget( "d3up.itemBuilder", {
		ignored: ['min-damage', 'max-damage', 'plus-damage', 'plus-aps'],
		controls: false,
		elements: {
			modify: $("<a class='btn' data-for='modify'>Modify</a>"),
			body: false,
			bottom: false,
			top: false,
			editor: false
		},
		options: {
			item: false,
			modified: {},
		},
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
		_modifyStat: function(event) {
			console.log("_modifyAttr");
			var modified = this.options.modified,
					target = $(event.currentTarget),
					stat = target.data("stat"),
					value = target.val();
			if(!modified.stats) {
				modified.stats = {};
			}
			modified.stats[stat] = Number(value);
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
			// Add the Stats Options
			this._createPaneStats();
			// Add the Attribute Options
			this._createPaneAttrs();
		},
		_createPaneStats: function() {
			console.log("_createPaneStats");
			var item = this.options.item,
					editor = this.elements.editor;
			_.each(item.stats, function(value, stat) {
				var input = $("<input type='text'>"),
						label = $("<label>");
				input.attr("name", stat).attr("data-stat", stat).val(value);
				label.attr("for", stat).html(stat);
				editor.append(label, input);
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
				// $.ajax({
				// 	type: 'POST',
				// 	data: this.options.modified
				// });
				console.log("saving");				
			}
			console.log(this.options.modified);
		},
		_init: function() {
			console.log("_init");
			// Assign some initial elements
			this.elements.item = this.element.find(".item");
			this.elements.top = this.element.find(".top");
			this.elements.bottom = this.element.find(".bottom");
			// Create our Toggle
			this._addToggle();
			// Create our Edit Pane
			this._createPane();
			// Add Bindings to all buttons
			this._addBindings();
		}
	});
})( jQuery );
