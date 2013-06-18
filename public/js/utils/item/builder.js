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
					search = $("<input type='text'>");
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
			var attrs = this.elements.attrs,
					li = $("<li>"),
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
		// init: function() {
		// 	// Do we have an edit button on this page?
		// 	if(this.options.editButton) {
		// 		// Hide it on init
		// 		$(this.options.editButton).hide();
		// 	}
		// 	this._createControls();
		// 	this._createFields();
		// 	
		// },
		// _destroy: function() {
		// 	console.log("_destroy");
		// 	var $this = this;
		// 	// Do we have an edit button on this page?
		// 	if(this.options.editButton) {
		// 		// Show it on destroy
		// 		$(this.options.editButton).show();
		// 	}
		// 	// Remove the Controls
		// 	this.controls.remove();
		// 	// Remove all the Inputs
		// 	$.each(this.element.find("[data-modify]"), function() {
		// 		var wrapper = $("<span>");
		// 		if($(this).data("range")) { 
		// 			wrapper.html($this.originals[$(this).data('modify') + "~min"] + " - " + $this.originals[$(this).data('modify') + "~max"]);
		// 		} else {
		// 			wrapper.html($this.originals[$(this).data('modify')]);					
		// 		}
		// 		wrapper.attr("data-modify", $(this).data("modify"));
		// 		if($(this).data("range")) {
		// 			wrapper.attr("data-range", true)
		// 		}
		// 		$(this).replaceWith(wrapper);
		// 	});
		// 	// Reset the Modified attributes
		// 	this.options.modified = {};
		// 	// Call _super
		// 	return this._super();
		// },
		// _createControls: function() {
		// 	var group = $("<span class='btn-group'>"),
		// 			save = $("<a class='btn btn-danger'>Save</a>"),
		// 			cancel = $("<a class='btn'>Cancel</a>"),
		// 			revert = $("<a class='btn'>Revert</a>"),
		// 			stat = $("<a class='btn btn-success'>Add Stat</a>");
		// 	// Add the controls on this for easy removal
		// 	this.controls = group;
		// 	// Bind all these inputs
		// 	save.on('click', $.proxy(this, '_save'));
		// 	cancel.on('click', $.proxy(this, '_destroy'));
		// 	revert.on('click', $.proxy(this, '_revert'));
		// 	stat.on('click', $.proxy(this, '_appendAttrMenu'));
		// 	// Add the Controls after the item
		// 	this.element.after(group.append(stat, cancel, revert, save));
		// },
		// _appendAttr: function(attr) {
		// 	console.log("Adding attr: " + attr);
		// 	var item = $("<li>"),
		// 			span = "<span data-modify='" + attr + "'>" + 0 + "</span>",
		// 			text = d3up.gameData.attributes[attr],
		// 			selector = "[data-modify=" + attr + "]";
		// 	item.html(text.replace('[X]', span));
		// 	this.element.find(".attrs").append(item);
		// 	this._createFields(selector);
		// 	this.element.find(selector).focus();
		// },
		// _appendAttrMenu: function() {
		// 	var $this = this,
		// 			container = $("<div class='modal hide fast'>"),
		// 			header = $("<div class='modal-header'>");
		// 			body = $("<div class='modal-body'>"),
		// 			footer = $("<div class='modal-footer'>"), 
		// 			stats = $("<input type='text' class='input-block-level'>");
		// 	header.html("<h3>Select an Attribute to Add</h3>");
		// 	body.html("<p>Start typing the name of an attribute to search through the available choices. Then either click the attribute you want or hit enter to continue.</p>");
		// 	body.append(stats);
		// 	body.append("<p><strong>Note</strong>: Your cursor will automatically focus to the new stat for easy data entry.</p>");
		// 	container.append(header, body, footer);
		// 	container.modal({
		// 		height: 500
		// 	});
		// 	stats.typeahead({
		// 		source: _.values(d3up.gameData.attributes),
		// 		updater: function(item) {
		// 			var inverse = _.invert(d3up.gameData.attributes);
		// 			$this._appendAttr(inverse[item]);
		// 			container.modal("hide");
		// 		}
		// 	});
		// 	stats.focus();
		// },
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
