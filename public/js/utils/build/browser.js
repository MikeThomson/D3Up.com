/*jslint devel: true*/
/*global _: true*/
/*global jQuery: true*/
/*global Handlebars: true*/
/*global History: true*/
/*global window: true*/
/*global checkSkillTip: true*/
(function($) {
	'use strict';
	// English (Template)
	jQuery.timeago.settings.strings = {
	  prefixAgo: "Age:",
	  seconds: "<1m",
	  minute: "~1m",
	  minutes: "~%dm",
	  hour: "~1h",
	  hours: "~%dhrs",
	  day: "~1d",
	  days: "~%dd",
	  month: "~1m",
	  months: "~%dm",
	  year: "~1y",
	  years: "~%dy"
	};
	$.widget( "d3up.buildBrowser", {
		results: {},
		d3: {
			regions: {
				1: {
					short: 'US'
				},
				2: {
					short: 'EU'
				},
				3: {
					short: 'AS'
				}
			},
			classes: [
				'barbarian', 
				'demon-hunter', 
				'monk', 
				'witch-doctor', 
				'wizard'
			]
		},
		options: {
			url: 'http://api.d3up.com/builds',
			filters: false,
			footer: false,
			container: false,
			paginator: $("<div class='btn-group pull-right'>"),
			paginators: false,
			columns: [
				'icon', 
				'name', 
				'region_type',
				'level', 
				'paragon', 
				'actives', 
				'passives', 
				'dps', 
				'ehp'
			]
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
			// Create the Class Filter
			this._createFilters();
			// Create the Paginators
			this._createPaginators();
			// Add the Column Headers
			this._buildColumnHeaders();
			// If we're using a Battle Tag in the search..
			if(this.getState().data.battletag) {
				// Add the Toggle Buttons for D3Up/BNet
				this._addSearchSource();				
			}
			// Attempt to setup the Skill Filters
			this.updateSkillFilters();
			// Run update immediately to populate default data
			this.update();
		},
		_showBattlenetSearch: function() {
			// Hide D3Up's button and show BNets
			$(".btn.d3upcom").hide();
			$(".btn.battlenet").show();
			// Show the D3Up Controls
			this.options.filters.find("tr.filters").show();
		},
		_showD3UpcomSearch: function() {
			// Show D3Up's button and hide BNets
			$(".btn.d3upcom").show();
			$(".btn.battlenet").hide();
			// Hide all the D3Up Filters
			this.options.filters.find("tr.filters").hide();
		},
		_addSearchSource: function() {
			var footer = this.options.footer.find("td"),
					bnet = $("<a type='btn' data-value='true' class='btn battlenet' name='battlenet'>").html("Search Battle.net"),
					d3up = $("<a type='btn' data-value='null' class='btn d3upcom' name='battlenet'>").html("Search D3Up.com");
			this._on(bnet, {click: '_updateState'});
			this._on(d3up, {click: '_updateState'});
			footer.append(bnet, d3up);
		},
		_createPaginators: function() {
					// Get the Current State information
			var state = this.getState().data,
					// Grab the Paginator Template
					paginator = this.options.paginator.clone(),
					// Get all Elements defined as paginator containers
					paginators = this.options.paginators,
					// Build our Controls
					nextBtn = $("<a class='btn next'>").html("Next"),
					currBtn = $("<a class='btn curr'>"),
					prevBtn = $("<a class='btn prev'>").html("Previous"),
					frstBtn = $("<a class='btn first'>").html("<<");
			if(state.page > 1) {
				// If the page is set, put it in the current button
				currBtn.html(state.page);
			} else {
				// Otherwise set page to 1 and hide the 1st/prev buttons
				currBtn.html(1);
				prevBtn.hide();
				frstBtn.hide();
			}
			// Create all the Bindings
			nextBtn.bind('click', $.proxy(this, "changePage", 1));
			prevBtn.bind('click', $.proxy(this, "changePage", -1));
			frstBtn.bind('click', $.proxy(this, "changePage", -1000));
			// Create our paginator html elements
			paginator.append(frstBtn, prevBtn, currBtn, nextBtn);
			// For each paginator specified
			paginators.each(function() {
				// Find the TD element
				var target = $(this).find("td");
				// If our element doesn't have one, make one
				if(!target.length) {
					$(this).append($("<tr>").append($("<td colspan='100'>")));
				}
				// Append a clone of our paginator with all events
				$(this).find("td").append(paginator.clone(true));				
			});
		},
		changePage: function(page) {
			// Grab a copy of the state's data
			var state = this.getState().data,
				currBtn = $(".btn.curr"),
				inc = arguments[page];
			// Modify the Value we're changing
			state.page = parseInt(state.page, 10) + inc;
			// Don't store null states
			if(state.page <= 1) {
				$(".btn.prev").hide();				
				$(".btn.first").hide();
				state.page = 1;
			} else {
				$(".btn.prev").show();				
				$(".btn.first").show();
			}
			currBtn.html(state.page);
			// Push the Updates to History
			this.pushState(state, "", "?" + $.param(state));
		},
		_createFilter: function(name, options) {
			// Create the Select Element 
			var select = $("<select name='" + name + "' id='d3up_buildBrowser_" + name + "'>");
			// Each option we're passed, make into a HTML element
			$.each(options, function(k,v) {
				// Is this an object? If so, lets use it's name
				if(typeof v === "object") {
					v = v.name;
				}
				// Define the HTML Element and append
				select.append($("<option value='" + k + "'>" + v + "</option>"));
			});
			// Bind the Change event to push the modified state to History
			this._on(select, {change: '_updateState'});
			return select;
		},
		_updateState: function(select) {
			// Grab a copy of the state's data
			var state = this.getState().data,
					name = $(select.currentTarget).attr("name");
			// Modify the Value we're changing
			state[name] = $(select.currentTarget).val();
			// If we didn't get a value, try to get data-value
			if(!state[name]) {
				state[name] = $(select.currentTarget).data('value');
			}
			// Ensure we have no null values to prevent URL pollution. 
			$.each(state, function(k) {
				if(state[k] === null || state[k] === "null") {
					delete state[k];
				}
			});
			// Push the Updates to History
			this.pushState(state, "", "?" + $.param(state));
		},
		_createSkillFilter: function(name, options) {
			// Create the Select Element 
			var $this = this,
				select = $("<select multiple='multiple' name='" + name + "' id='d3up_buildBrowser_" + name + "'>"),
				// Each option we're passed, make into a HTML element
				optGroup;
			$.each(options, function(k,v) {
				if(!k.match(/~/)) {
					optGroup = $("<optgroup label='" + v.name + "'>");
					select.append(optGroup);
				} else {
					// Is this an object? If so, lets use it's name
					if(typeof v === "object") {
						v = v.name;
					}
					// Define the HTML Element and append
					optGroup.append($("<option value='" + k + "'>" + v + "</option>"));					
				}
			});
			// Bind the Change event to push the modified state to History
			select.on('change', function() {
				// Grab a copy of the state's data
				var state = $this.getState().data,
					value = $(this).val();
				// Modify the Value we're changing
				if(value !== null) {
					state[name] = value.join("|");					
				} 
				// Don't store null states
				if(value === null || state[name] === null || state[name] === "null") {
					delete state[name];
				}
				// Push the Updates to History
				$this.pushState(state, "", "?" + $.param(state));
			});
			// Remove any selected values (to prevent any default selection)
			select.find("option").removeAttr("selected");
			return select;
		},
		_createFilters: function() {
			var wrapper = $("<tr class='filters'>"),
				container = $("<td colspan='100'>"),
				state = this.getState().data,
				// Build the Sort Filter
				optionsSort = {
					'null': 'Recently Updated',
					dps: 'Highest DPS',
					ehp: 'Highest EHP'
				},
				// Build the Authentic Search Filter
				optionsAuthentic = {
					'null': 'Show All Builds',
					'true': 'Authentic Only'
				},
				// Build the Class Selector
				optionsClass = {
					'null': 'All Classes'
				}, classFilter;
			// Iterate over classes and build the params for _createSelect
			_.each(this.d3.classes, function(v) {
				optionsClass[v] = v.split("-").join(" ");
			});
			// Build the class filter select
			classFilter = this._createFilter("class", optionsClass, state['class']);
			// Append it to the container
			container.append(classFilter);
			// Bind the updateSkillFilters function to the class changer
			this._on(classFilter, {
				change: $.proxy(this, 'updateSkillFilters')
			});
			
			// Build the Select and append it to the container
			container.append(this._createFilter("sort", optionsSort, state.sort));
			// Build the Select and append it to the container
			container.append(this._createFilter("authentic", optionsAuthentic, state.authentic));
			// Append the Container to the Wrapper
			wrapper.html(container);
			// Then finally add it into the filters
			this.options.filters.append(wrapper);
		},
		updateSkillFilters: function() {
			var $this = this, state = this.getState().data,
				// Find the Filters
				filters = this.options.filters.find(".filters td"),
				wrapper = $('<div class="input-append btn-toolbar actives">'),
				reset = $('<button class="btn btn-danger">Reset</button>'),
				select;
			// Remove the old Filter
			filters.find("select[name=actives], .actives").remove();
			// Do we have the skill data loaded and a class selected?
			if(window.d3up && window.d3up.gameData && state['class']) {
				select = this._createSkillFilter("actives", window.d3up.gameData.actives[state['class']]);
				reset.bind('click', function() {
					var select = $this._createSkillFilter("actives", window.d3up.gameData.actives[state['class']]);
					select.find("option").removeAttr('selected').prop('selected', false);
					select.multiselect('refresh');
					select.trigger('change');
				});
				filters.append(wrapper.append(select, reset));
				select.multiselect({
					maxHeight: 250,
					enableFiltering: true,
					filterPlaceholder: 'Search Skills',
					buttonText: function(options) {
						var text;
						if (options.length === 0) {
							text = 'No Skills Selected<b class="caret"></b>';
						} else {
							text = options.length + ' selected  <b class="caret"></b>';
						}	
						return text;
					}
				});
			}
		},
		update: function () {
			var container = this.options.container,
				row = $("<tr>"),
				state = this.getState();
			// Remove the Previous Results
			container.empty();
			row.append($("<td colspan='100' class='loading'>").html("Loading"));
			container.append(row);
			if(!state.data.battlenet) {
				this._showBattlenetSearch();
			}	else {
				this._showD3UpcomSearch();
			}
			// Update the Filters to match the state
			$.each(state.data, function(k,v) {
				// Update any filters to match what's in the state data
				var el = $("#d3up_buildBrowser_" + k);
				// Never pass a null value, this ensures it.
				if(v === null || v === 'null') {
					delete state.data[k];
					return;
				}
				if(el) {
					// Need special actions on actives
					if(k === 'actives') {
						if(v !== null) {
							el.val(v.split("|"));
							el.multiselect('refresh');						
						}
					} else {
						el.val(v);					
					}
				}
			});
			// Perform the API call with the state data
			$.ajax({
				type: 'GET',
				url: this.options.url,
				data: state.data,
				dataType: 'jsonp',
				jsonpCallback: 'd3up_bb_process'
			})
			// When the request completes, process the data
			.done($.proxy(this, 'process'));
		},
		_buildColumnHeaders: function() {
			var filters = this.options.filters,
					columns = this.options.columns,
					tr = $("<tr>");
			_.each(columns, function(v) {
				var td = $("<td>");
				switch(v) {
					case "region_type":
						v = "Region/Type";
						break;
					case "dps":
					case "ehp":
						v = v.toUpperCase();
						break;
					default:
						v = v.charAt(0).toUpperCase() + v.slice(1);
						break;
				}
				td.html(v);
				tr.append(td);
			});
			filters.append(tr);
		},
		process: function(data) {
			// Grab the Container 
			var container = this.options.container.empty(),
					state = this.getState(),
					$this = this,
					row = $("<tr>"),
					cell = $("<td colspan='100'>"),
					content = $("<div class='json-response'>"),
					requested = $("<div>We could not find a build on D3Up that matches:</div>"),
					params = $("<ul>");
			// Store the Results on the browser
			this.results = data;
			// No results? Return the row telling the user
			if($.isEmptyObject(data)) {
				content.append($("<h3>").append("No Builds Found."));
				$.each(state.data, function(k,v) {
					if(v !== null && v !== "null" && k !== 'page' && k !== 'battlenet') {
						// Display it properly to avoid confusion
						if(k === "battletag") {
							v = v.replace("-","#");
						}
						var li = $("<li>"),
							name = k.replace("_"," ").capitalize(),
							value = v.replace("-"," ").capitalize();
						li.append(name, ": ", value);
						params.append(li);						
					}
				});
				if(state.data.battlenet) {
					if(state.data.battletag) {
						content.append($("<p class='label label-error'>").append("No builds were found on Battle.net with this Battle Tag."));					
					}					
				} else {
					requested.append(params);
					content.append(requested);					
					if(state.data.battletag) {
						content.append($("<p class='label label-info'>").append("Click 'Search Battle.net' below to search through Battle.net Characters."));					
					}
				}
				row.append(cell.html(content));
				container.append(row);
				$(".btn.next").hide();
				return;
			}
			// Did we get an error back?
			if(data.error) {
				row.append(cell.html(data.error));
				container.append(row);
				return;				
			}
			// Iterate through our results and add new rows
			_.each(data, function(data) {
				var row = $("<tr>"),
					create = $("<a class='btn pull-right'>").html("Create New Build"),
					info = "Located on Battle.net",
					qs = "character-bt=" + data['bt-tag'].replace("#", "-")
						+"&character-rg=" + data['bt-rg']
						+"&character-id=" + data['bt-id']
						+"&name=" + data.name
						+"&class=" + data['class']
						+"&hardcore=" + data.hardcore
						+"&level=" + data.level
						+"&paragon=" + data.paragon;
				_.each($this.options.columns, function(col) {
					switch(col) {
						case "icon":
							row.append($this.makeColumn(col, [data['class'], data.gender]));
							break;
						case "region_type":
							var region = $this.d3.regions[data['bt-rg']].short;
							row.append($this.makeColumn(col, [region, data.hardcore]));
							break;
						case "actives":
							if(data.actives) {
								row.append($this.makeColumn(col, [data['class'], data.actives]));																
							}
							break;
						case "passives":
							if(data.passives) {
								row.append($this.makeColumn(col, [data['class'], data.passives]));								
							}
							break;
						case "level":
						case "paragon":
							if(data[col] === null) {
								data[col] = 0;								
							}
							row.append($this.makeColumn(col, [data[col], data.id]));
							break;
						default:
							row.append($this.makeColumn(col, [data[col], data.id, data]));
							break;
					}
				});
				if(data.exists === false) {
					$this._showD3UpcomSearch();
					// Build one big ol' query string!
					create.attr("href", "/build/create?" + qs); 
					row.append($("<td colspan='100' class='battlenet-scan'>").append(create, info));
				}
				container.append(row);
				row.find("[data-toggle=popover]").popover({
					trigger: 'click',
					placement: 'top'
				});
			});
			// Show the next button incase it was hidden
			$(".btn.next").show();
			// Hook all Tooltips
			$(".d3-icon-skill, .passive-icon").each(checkSkillTip);	
		},
		makeColumn: function(name, data) {
			var $this = this,
				td = $("<td>"),
				container = $("<span>"),
				date,
				link = $("<a href='/b/" + data[1] + "'>" + data[0] + "</a>"),
				updated = $("<span class='updated'>");
			td.addClass("d_" + name);
			switch(name) {
				case "icon":
					td.html($this.classIcon(data[0], data[1]));
					break;
				case "region_type":
					container.attr({
						'data-toggle': 'popover',
						'data-title': 'Region & Character Type'
					});
					if(data[1]) {
						container.attr({
							'data-content': 'This is a Hardcore character being played in the ' + data[0] + ' region.'
						});
						container.html(data[0] + "/HC");						
					} else {						
						container.attr({
							'data-content': 'This is a Softcore character being played in the ' + data[0] + ' region.'
						});
						container.html(data[0] + "/SC");
					}
					td.append(container);
					break;
				case "actives":
					_.each(data[1], function(v) { 
						var icon = $this.skillIcon(data[0], v);
						td.append(Handlebars.helpers.skillIcon.apply(icon, [data[0], v]).string);
					});
					break;
				case "passives":
					_.each(data[1], function(v) { 
						var icon = $this.passiveIcon(data[0], v);
						td.append(Handlebars.helpers.passiveIcon.apply(icon, [data[0], v]).string);
					});
					break;
				case "name":
					if(data[1]) {
						date = new Date(data[2].updated * 1000);
						updated.attr("title", date.toISOString());
						updated.timeago();
						td.append(link, updated);						
					} else {
						td.html(data[0]);
					}
					break;
				default:
					td.html(data[0]);
					break;
			}
			return td;
		},
		passiveIcon: function(heroClass, skill) {
			// Some Cleanup to make our data match Blizzard's
			heroClass = heroClass.replace(/-/g, "");
			skill = skill.replace(/-/g, "");	
			// Generate the Icon URL 
			var url = "http://media.blizzard.com/d3/icons/skills/42/" + heroClass + "_passive_" + skill + ".png";
			return $("<img src='" + url + "'>");			
		},
		skillIcon: function(heroClass, skill) {
			// Some Cleanup to make our data match Blizzard's
			heroClass = heroClass.replace(/-/g, "");
			skill = skill.replace(/-/g, "").split("~")[0];	
			// Generate the Icon URL 
			var url = "http://media.blizzard.com/d3/icons/skills/42/" + heroClass + "_" + skill + ".png";
			return $("<img src='" + url + "'>");			
		},
		classIcon: function(heroClass, gender) {
			heroClass = heroClass.replace("-", "");
			var urlTemplate = 'http://media.blizzard.com/d3/icons/portraits/42/|heroClass|_|gender|.png',
				url = urlTemplate.replace("|gender|", gender).replace("|heroClass|", heroClass);					
			return $("<img src='" + url + "'>");
		},
		// _hover: function() {
			// Methods with an underscore are "private"
		// },
		_destroy: function() {
			// Use the destroy method to reverse everything your plugin has applied
			return this._super();
		},
		getState: function() {
			return History.getState();
		},
		replaceState: function(data) {
			return History.replaceState(data);
		},
		pushState: function(state, name) {
			return History.pushState(state, name, "?filter=" + $.base64.encode(JSON.stringify(state)));
		},
		getParameterByName: function(name, defaultValue) {
			name = name.replace(/[\[]/, /\\\[/).replace(/[\]]/, /\\\]/);
			var regexS = "[\\?&]" + name + "=([^&#]*)",
				regex = new RegExp(regexS),
				results = regex.exec(window.location.search),
				value;
			if(results === null && defaultValue) {
				value = defaultValue;
			} else if(results === null) {
				value = null;				
			} else if(results[1].replace(/\+/g, " ") === "null") {
				value = null;
			} else if (results[1].replace(/\+/g, " ") === "NaN") {
				value = null;				
			} else {
				value = decodeURIComponent(results[1].replace(/\+/g, " "));
			}
			return value;
		}
	});
}( jQuery ));