/*jslint devel: true*/
/*global _: true*/
/*global jQuery: true*/
/*global Handlebars: true*/
/*global window: true*/
/*global d3up: true*/
(function($) {
	'use strict';
	$.widget( "d3up.itemBuilder", {
		ignored: ['min-damage', 'max-damage', 'plus-damage', 'plus-aps'],
		ranges: ['damage', 'block-amount'],
		_create: function() {
			console.log("_create");
		},
		_addToggle: function() {
			var item = this.elements.item,
					modify = this.elements.modify;
			item.prepend(modify);
		},
		_addBindings: function() {
			var el = this.element;
			// Modal/Save Bindings
			el.on('click', '#modal-save [data-save]', $.proxy(this, '_saveAction'));
			// Top Control Bindings
			el.on('keyup', '[data-for=name]', $.proxy(this, '_modifyName'));
			el.on('click', '[data-for=collapse]', $.proxy(this, '_toggleCollapse'));
			// Item Editor Bindings
			el.on('click keypress', '[data-for=modify]', $.proxy(this, '_createPane'));
			el.on('change', '[data-type]', $.proxy(this, '_modifyType'));
			el.on('keyup', '[data-attr]', $.proxy(this, '_modifyAttr'));
			el.on('keyup', '[data-stat]', $.proxy(this, '_modifyStat'));
			el.on('click', '[data-for=attr-remove]', $.proxy(this, '_modifyAttrRemove'));
			el.on('click keypress', '[data-for=attr-add]', $.proxy(this, '_addAttrFinder'));
			el.on('change', '[data-for=socket]', $.proxy(this, '_modifySocket'));
			el.on('click keypress', '[data-for=socket-remove]', $.proxy(this, '_modifySocketRemove'));
			el.on('click keypress', '[data-for=socket-add]', $.proxy(this, '_modifySocketAdd'));
			// Bottom Control Bindings
			el.on('click keypress', '[data-for=save]', $.proxy(this, '_save'));
			el.on('click keypress', '[data-for=revert]', $.proxy(this, '_revert'));
			el.on('click keypress', '[data-for=cancel]', $.proxy(this, '_cancel'));
		},
		_addAttrFinder: function() {
			var $this = this,
					attrs = this.elements.attrs,
					li = $("<li>"),
					search = $("<input type='text' class='input-block-level'>");
			search.attr("placeholder", "Start typing the name and press enter");
			search.typeahead({
				source: function() {
					// Get the attrs that exist on the item
					var existing = _.keys($this.options.item.attrs),
							// All attributes in the game
							all = _.keys(d3up.gameData.attributes),
							// The keys that don't exist on the item, to avoid adding dupe attrs
							searchable = _.difference(all, existing), 
							results = [];
					// Add all of our non-existant stats
					_.each(searchable, function(attr) {
						results.push(d3up.gameData.attributes[attr]);
					});
					// Add back the ones we've removed this session to the searchable list
					_.each(_.keys($this.options.modified.attrs), function(attr) {
						results.push(d3up.gameData.attributes[attr]);
					}); 
					return results;
				},
				updater: function(item) {
					var inverse = _.invert(d3up.gameData.attributes);
					li.replaceWith($this._createPaneAttr(inverse[item], 1));
					attrs.find("[data-attr='" + inverse[item] + "'] input").focus();
				}
			});
			attrs.append(li.append(search));
			li.find("input").focus().select();
		},
		_modifySocket: function(event) {
			console.log("_modifySocket");
			var modified = this.options.modified,
					target = $(event.currentTarget),
					socket = target.data("socket"),
					value = target.val();
			if(!modified.sockets) {
				modified.sockets = [];
			}
			modified.sockets[socket] = value;
			this._update();
		},
		_modifySocketRemove: function(event) {
			console.log("_modifySocketRemove");
			var modified = this.options.modified,
					target = $(event.currentTarget),
					socket = target.data("socket");
			target.closest("li").remove();
			if(!modified.sockets) {
				if(this.options.item.sockets) {
					modified.sockets = this.options.item.sockets;
				} else {
					modified.sockets = [];
				}
				
			}
			modified.sockets[socket] = null;
			this._update();			
		},
		_modifySocketAdd: function() {
			console.log("_modifySocketRemove");
			var modified = this.options.modified,
					item = this.options.item,
					editor = this.elements.editor,
					sockets = editor.find(".sockets"),
					li = $("<li>"),
					nextIdx = 0,
					newSocket;
			if(!$.isEmptyObject(item.sockets)) {
				nextIdx = Math.max.apply(Math, _.keys(item.sockets)) + 1;				
			}
			// Ensure our modified properties has sockets
			if(!modified.sockets) {
				modified.sockets = {};
			}
			// Append our new empty socket
			modified.sockets[nextIdx] = "empty";
			// Ensure our item has sockets
			if(!item.sockets) {
				item.sockets = {};
			}
			// Append our new empty socket
			item.sockets[nextIdx] = "empty";
			if(nextIdx > 0) {
				sockets.append(li.append(this._createSocketSelect(nextIdx)));				
			} else {
				sockets.prepend(li.append(this._createSocketSelect(nextIdx)));
			}
			this._update();						
		},
		_modifyType: function(event) {
			console.log("_modifyType");
			var modified = this.options.modified,
					target = $(event.currentTarget),
					key = target.data("type"),
					value = target.val();
			if(key === 'quality') {
				modified[key] = Number(value);
				this._modifyItemQuality();
			} else if(key === 'type') {
				modified[key] = value;				
				this._modifyItemType();
			}
			this._update();
			console.log(JSON.stringify(modified));			
		},
		_modifyItemQuality: function() {
			// The Element
			var el = this.element,
					// Our "Old" Quality
					old = this.options.item.quality,
					// Our "Possible" Quality
					pos = this.options.modified.quality;
			console.log(old, pos);
			// Swap out all old classes on the tooltip
			el.find(".quality-" + old)
				.removeClass("quality-" + old)
				.addClass("quality-" + pos);
			el.find(".item-quality-" + old)
				.removeClass("item-quality-" + old)
				.addClass("item-quality-" + pos);
			// Set the new quality as current
			this.options.item.quality = pos;
		},
		_modifyItemType: function() {
			console.log("_modifyItemType");
			// Remove the item's stats
			this.options.modified.stats = {};
			_.each(_.keys(this.options.item.stats), function(k) {
				console.log("nulling", k);
				this.options.modified.stats[k] = null;
			}, this);
			this.options.item.stats = {};
			this.options.item.type = this.options.modified.type;
			// What item class is this?
			var itemClass = d3up.Calc.prototype.itemClass(this.options.modified.type);
			_.each(d3up.gameData.itemStats[itemClass], function(stat) {
				var parts = stat.split("~");
				if(parts.length > 1) {
					this.options.item.stats[parts[0] + "~" + parts[1]] = 1;
				} else {
					this.options.item.stats[stat] = 1;					
				}
			}, this);
			_.extend(this.options.modified.stats, this.options.item.stats);
			this._removePane();
			this._createPane();
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
		_modifyName: function(event) {
			console.log("_modifyName");
			var modified = this.options.modified,
					target = $(event.currentTarget),
					value = target.val();
			modified.name = value;
			this._update();
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
		},
		_modifyAttrRemove: function(event) {
			console.log("_modifyAttrRemove");
			var target = $(event.currentTarget),
					remove = target.closest("li"),
					attr = remove.data("attr"),
					modified = this.options.modified;
			if(!modified.attrs) {
				modified.attrs = {};
			}
			modified.attrs[attr] = 0;
			// Remove the actual row
			remove.remove();
			this._update();			
		},
		_createPane: function() {
			console.log("_createPane");
			var group = $("<div class='btn-group'>"),
				titlebar, icon, editor, controls;
			titlebar = this.elements.titlebar = this.element.find(".top").clone().empty();
			icon = this.elements.item.find(".item-icon").clone();
			editor = this.elements.editor = $("<div class='item item-editor well-small'>");
			controls = this.elements.controls = $("<div class='bottom btn-toolbar'>");
				
			// Quickly add some buttons to the group
			group.append($("<a class='btn' href='#' dAta-for='save'>Save</a>"));
			group.append($("<a class='btn' href='#' data-for='revert'>Revert</a>"));
			group.append($("<a class='btn' href='#' data-for='cancel'>Cancel</a>"));
			// Append the Button Group
			controls.append(group);
			// Clone the Icon in-place
			titlebar.append($("<div class='item'>").append(icon.addClass("item-icon-box pull-left")));
			// Append the titlebar after the actual .top
			this.elements.top.after(titlebar);
			// Append the Editor after the actual .item
			this.elements.item.after(editor);
			// Append the new Controls
			this.elements.bottom.append(controls);
			// Hide the top 
			this.elements.top.hide();
			// Hide the item
			this.elements.item.hide();
			// Add the Item's Name input
			this._createPaneName();
			// Add the Item Types
			this._createPaneTypes();
			// Add the Stats Options
			this._createPaneStats();
			// Add the Attribute Options
			this._createPaneAttrs();
			// Add the Socket Options
			this._createPaneSockets();
		},
		_createPaneSockets: function() {
			console.log("_createPaneSockets"	);
			var editor = this.elements.editor,
				controls = this.elements.controls,
				list = $("<ul class='sockets'>"),
				item = this.options.item,
				newSocket = $("<a class='btn pull-left' data-for='socket-add'>");
			newSocket.html("Add Socket");
			_.each(item.sockets, function(gem, socket) {
				var li = $("<li>");
				li.attr("data-socket", socket);
				li.addClass("gem_" + gem);
				li.html(this._createSocketSelect(socket));
				list.append(li);
			}, this);
			controls.prepend(newSocket);
			editor.append(list);
		},
		_createSocketSelect: function(socket) {
			console.log("_createSocketSelect" + socket);
			var itemType = this.options.item.type,
				itemClass = d3up.Calc.prototype.itemClass(itemType),
				current = this.options.item.sockets[socket],
				gems = d3up.gameData.gems,
				wrapper = $("<div class='input-append'>"),
				remove = $("<button class='btn'>Remove</button>"),
				select = $("<select>"),
				empty = $("<option value='empty'>Empty Socket</option>");
			// Set the data-type to socket-remove for binding
			remove.attr("data-for", 'socket-remove');
			// Set the Socket Identifier
			remove.attr("data-socket", socket);
			// Set the data-type to socket for binding
			select.attr("data-for", 'socket');
			// Set the Socket Identifier
			select.attr("data-socket", socket);
			_.each(_.keys(gems).reverse(), function(gem) {
				var idx, option = $("<option>");
				// Set the value equal to the name of the gem
				option.val(gem);
				// This ugly if statement will determine the gem effect
				if(itemClass === 'weapon') {
					idx = 2;
				} else if(_.indexOf(["spirit-stone","voodoo-mask","wizard-hat","helm"], itemType) >= 0) {
					idx = 1;
				} else {
					idx = 3;
				}
				// If this is the gem we have, select it
				if(gem === current) {
					option.attr("selected", "selected");
				}
				// Set the HTML to the name and effect
				option.html(gems[gem][0] + " (" + gems[gem][idx] + ")");
				// Append the option to the select
				select.append(option);
			});
			// Add the "Empty" option
			if(current === 'empty' || current === undefined) {
				empty.attr("selected", "selected");
			}
			select.append(empty);
			return wrapper.append(select, remove);
		},
		_createPaneName: function() {
			console.log("_createPaneName");
			var item = this.options.item, 
					titlebar = this.elements.titlebar,
					wrapper = $("<p>"),
					collapse = $("<i data-for='collapse' class='icon-collapse pull-left'></i>"),
					input = $("<input type='text' data-for='name'>");
			input.val(item.name);
			titlebar.append(wrapper.append(collapse, input));
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
				if(String(item.quality) === key) {
					li.attr("selected", "selected");
				}
				quality.append(li);
			}, this);
			editor.append($("<div>").append(quality, type));
		},
		_toggleCollapse: function(event) {
			var target = $(event.currentTarget),
					editor = this.elements.editor,
					controls = this.elements.controls;
			target.toggleClass("icon-rotate-270");
			editor.toggle();
			controls.toggle();
		},
		_createPaneStats: function() {
			console.log("_createPaneStats");
			var item = this.options.item,
					editor = this.elements.editor;
			_.each(item.stats, function(value, stat) {
				var input = $("<input type='text'>"),
					input2 = input.clone(),
					container = $("<div>"),
					container2 = container.clone(),
					text = d3up.gameData.stats[stat];
				if(_.indexOf(this.ranges, stat) >= 0) {
					container.html("Min " + text);
					container2.html("Max " + text);
					input.val(value.min)
						.addClass("range")
						.attr('data-stat', stat + '~min');
					input2.val(value.max)
						.addClass("range")
						.attr('data-stat', stat + '~max');
					editor.append(container.prepend(input), container2.prepend(input2));
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
					remove = $("<i data-for='attr-remove' class='icon-ban-circle'>"),
					input = "<input type='text' value='" + value + "'>",
					modified = this.options.modified;
			if(!text.match(/\[X\]/g)) {
				if(!modified.attrs) {
					modified.attrs = {};
				}
				modified.attrs[attr] = 1;				
			}
			text = text.replace(/\[X\]/g, input);
			li.attr('data-attr', attr).html(text).append(remove);
			return li;
		},
		_createPaneAttrs: function() {
			console.log("_createPaneAttrs");
			var item = this.options.item,
				controls = this.elements.controls,
				editor = this.elements.editor,
				attrs = $("<ul class='attrs'>");
			this.elements.attrs = attrs;
			_.each(item.attrs, function(value, attr) {
				attrs.append(this._createPaneAttr(attr, value));
			}, this);
			controls.prepend($("<a class='btn btn-mini pull-left' href='#' data-for='attr-add'>Add Attribute</a>"));
			editor.append(attrs);
		},
		_removePane: function() {
			// Destroy the elements created in _createPane
			this.elements.titlebar.remove();
			this.elements.editor.remove();
			this.elements.controls.remove();
			// Show the old fields from the tooltip
			this.elements.top.show();
			this.elements.item.show();
			// Unhide elements we need
			this.elements.top.find("p").show();
		},
		_cancel: function() {
			this._revert();
			if(this.options.onCancel) {
				this.options.onCancel();
			}
			this.destroy();
		},
		_revertPane: function() {
			// Remove the old pane
			this._removePane();
			// Create a new pane (Was an easy way to reset)
			this._createPane();
		},
		_revertItem: function() {
			// Reset our item to a clone of the original
			this.options.item = _.cloneDeep(this.original);
			// Set our modified object to be empty
			this.options.modified = {};			
		},
		_revert: function() {
			// Revert the Item
			this._revertItem();
			// Revert the Pane
			this._revertPane();
			// Run an update
			this._update();
		},
		_save: function() {
			console.log("_save");
			// If we have no modifications, don't bother AJAXing
			if($.isEmptyObject(this.options.modified)) {
				// Swap back to the item view unaltered
				this._removePane();
			} else {
				if(this.options.authentic) {
					this.elements.saveModal.modal();					
				} else {
					this._saveAction();
				}
			}
		},
		_saveAction: function() {
			console.log("_saveAction");
			var $this = this;			
			// Issue the AJAX post to perform the updates
			$.ajax({
				url: '/i/' + this.options.item.id + '/edit',
				type: 'POST',
				data: this.options.modified 
			}).done(function(data) {
				// Once the AJAX is complete...
				var json = $.parseJSON(data),	// JSON Response
						html = json.html,	// HTML Render of the new Item
						item = json.item;	// JSON Data of the new Item
				// Remove the old Form
				$this._removePane();
				if($this.options.onSave) {
					// Call our onSave callback
					$this.options.onSave();						
				}
				// Replace the item's HTML with the new HTML
				$this.element.html($(html));
				// Assign our new item
				$this.options.item = item;
				// Remove all old modifications
				$this.options.modified = {};
				// Reinit our values with the new item
				$this._reinit();
				// Readd our toggle
				$this._addToggle();
				// Perform an update
				$this._update();
				// Hide the Modal
				$("#modal-save").modal("hide");
			});
		},
		_createSaveModal: function() {
			console.log("_createSaveModal");
			var container = $("<div id='modal-save' class='modal hide fade' tabindex='-1' role='dialog' aria-hidden='true'>"),
					header = $("<div class='modal-header'><button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button><h3>Are you sure?</h3></div>"),
					body = $("<div class='modal-body'></div>"),
					footer = $("<div class='modal-footer'><button class='btn' data-dismiss='modal' aria-hidden='true'>Cancel</button><button class='btn btn-primary' data-save='true'>Save</button></div>");
			this.elements.saveModal = container;
			body.append("Saving this item will cause your build to no longer be 'Authentic', indicating that you have changed the build somehow.");
			this.element.append(container.append(header, body, footer));
		},
		_update: function() {
			// Do we have a callback on our updates?
			if(this.options.onUpdate) {
				// Execute it and pass what's been modified
				this.options.onUpdate(this.options.modified);
			}
		},
		_assignElements: function() {
			this.elements = {
				item: this.element.find(".item"),
				top: this.element.find(".top"),
				bottom: this.element.find(".bottom"),
				modify: $("<a class='btn pull-right' data-for='modify'>Modify</a>")
			};
		},
		_reinit: function() {
			// Assign some initial elements
			this._assignElements();
			// Make sure our modified object exists
			if(!this.options.modified) {
				this.options.modified = {};
			}
			// Create a copy of the original for reverting
			this.original = _.cloneDeep(this.options.item);			
		},
		_init: function() {
			console.log("_init", this.options);
			// Initialize some options
			this._reinit();
			// Create our Toggle
			this._addToggle();
			// Add our 'Save' Modal
			this._createSaveModal();
			// Add Bindings to all controls
			this._addBindings();
			// If 'modding' was passed, we're starting off modifying
			if(this.options.modding) {
				this._createPane();
			}
		},
		_destroy: function() {
			this._revert();
			this._removePane();
		}
	});
}( jQuery ));
