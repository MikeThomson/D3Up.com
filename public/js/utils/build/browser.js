(function($) {
	// D3Up timago Template
	jQuery.timeago.settings.strings = {
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
	  years: "~%dy",
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
				},
			},
			classes: [
				'barbarian', 
				'demon-hunter', 
				'monk', 
				'witch-doctor', 
				'wizard'
			],
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
			// Set the Current State with whatever the URL Parameters are set to
			History.replaceState({
				'page': this.getParameterByName('page', 1),
				'class': this.getParameterByName('class', null),
				'sort': this.getParameterByName('sort', null),
				'actives': this.getParameterByName('actives'),
				'authentic': this.getParameterByName('authentic', null),
				'battletag': this.getParameterByName('battletag', null),
				'battlenet': this.getParameterByName('battlenet', null),
			});
			// Bind the window statechange event to our update method
			this._on(window, { statechange: "update" });
			// Create the Class Filter
			this._createFilters();
			// Create the Paginators
			this._createPaginators();
			// Add the Column Headers
			this._buildColumnHeaders();
			// If we're using a Battle Tag in the search..
			if(History.getState().data['battletag']) {
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
			// Show all the D3Up Filters
			this.options.filters.find("select").show();
		},
		_showD3UpcomSearch: function() {
			// Show D3Up's button and hide BNets
			$(".btn.d3upcom").show();
			$(".btn.battlenet").hide();
			// Hide all the D3Up Filters
			this.options.filters.find("select").hide();
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
			var state = History.getState().data,
					// Grab the Paginator Template
					paginator = this.options.paginator.clone(),
					// Get all Elements defined as paginator containers
					paginators = this.options.paginators,
					// Build our Controls
					nextBtn = $("<a class='btn next'>").html("Next"),
					currBtn = $("<a class='btn curr'>"),
					prevBtn = $("<a class='btn prev'>").html("Previous")
					frstBtn = $("<a class='btn first'>").html("<<");
			if(state['page'] > 1) {
				// If the page is set, put it in the current button
				currBtn.html(state['page']);
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
		changePage: function() {
			// Grab a copy of the state's data
			var state = History.getState().data,
					inc = arguments[0];
			// Modify the Value we're changing
			state['page'] = parseInt(state['page']) + inc;
			var currBtn = $(".btn.curr");
			// Don't store null states
			if(state['page'] <= 1) {
				$(".btn.prev").hide();				
				$(".btn.first").hide();
				state['page'] = 1;
			} else {
				$(".btn.prev").show();				
				$(".btn.first").show();
			}
			currBtn.html(state['page']);
			// Push the Updates to History
			History.pushState(state, "", "?" + $.param(state));
		},
		_createFilter: function(name, options) {
			// Create the Select Element 
			var select = $("<select name='" + name + "' id='d3up_buildBrowser_" + name + "'>");
			// Each option we're passed, make into a HTML element
			$.each(options, function(k,v) {
				// Is this an object? If so, lets use it's name
				if(typeof(v) == "object") {
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
			var state = History.getState().data,
					name = $(event.currentTarget).attr("name");
			// Modify the Value we're changing
			state[name] = $(event.currentTarget).val();
			// If we didn't get a value, try to get data-value
			if(!state['name']) {
				state[name] = $(event.currentTarget).data('value');
			}
			// Push the Updates to History
			if(state[name] == null || state[name] == "null") {
				delete state[name];
			}
			History.pushState(state, "", "?" + $.param(state));
		},
		_createSkillFilter: function(name, options) {
			// Create the Select Element 
			var select = $("<select multiple='multiple' name='" + name + "' id='d3up_buildBrowser_" + name + "'>");
			// Each option we're passed, make into a HTML element
			var optGroup = "";
			$.each(options, function(k,v) {
				if(!k.match("\~")) {
					optGroup = $("<optgroup label='" + v.name + "'>");
					select.append(optGroup);
				} else {
					// Is this an object? If so, lets use it's name
					if(typeof(v) == "object") {
						v = v.name;
					}
					// Define the HTML Element and append
					optGroup.append($("<option value='" + k + "'>" + v + "</option>"));					
				}
			});
			// Bind the Change event to push the modified state to History
			select.on('change', function() {
				// Grab a copy of the state's data
				var state = History.getState().data,
						value = $(this).val();
				// Modify the Value we're changing
				if(value != null) {
					state[name] = value.join("|");					
				} 
				// Don't store null states
				if(value == null || state[name] == null || state[name] == "null") {
					delete state[name];
				}
				// Push the Updates to History
				History.pushState(state, "", "?" + $.param(state));
			});
			// Remove any selected values (to prevent any default selection)
			select.find("option").removeAttr("selected");
			return select;
		},
		_createFilters: function() {
			var wrapper = $("<tr class='filters'>"),
					container = $("<td colspan='100'>"),
					state = History.getState().data;
			// Build the Class Selector
			var options = {
				null: 'All Classes'
			};
			// Iterate over classes and build the params for _createSelect
			$.each(this.d3.classes, function(k,v) {
				var name = v.split("-").join(" ");
				options[v] = name;
			});
			// Build the class filter select
			var classFilter = this._createFilter("class", options, state['class']);
			// Append it to the container
			container.append(classFilter);
			// Bind the updateSkillFilters function to the class changer
			this._on(classFilter, {
				change: $.proxy(this, 'updateSkillFilters')
			});
			// Build the Sort Filter
			var options = {
				null: 'Recently Updated',
				dps: 'Highest DPS',
				ehp: 'Highest EHP',
			}
			// Build the Select and append it to the container
			container.append(this._createFilter("sort", options, state['sort']));
			// Build the Authentic Search Filter
			var options = {
				null: 'Show All Builds',
				true: 'Authentic Only',
			}
			// Build the Select and append it to the container
			container.append(this._createFilter("authentic", options, state['authentic']));
			// Append the Container to the Wrapper
			wrapper.html(container);
			// Then finally add it into the filters
			this.options.filters.append(wrapper);
		},
		updateSkillFilters: function() {
			var state = History.getState().data;
			// Find the Filters
			var filters = this.options.filters.find(".filters td");
			// Remove the old Filter
			filters.find("select[name=actives], .actives").remove();
			// Do we have the skill data loaded and a class selected?
			if(window.d3up && window.d3up.gameData && state['class']) {
				// Build the Active Skill filter
				var wrapper = $('<div class="input-append btn-toolbar actives">'),
						select = this._createSkillFilter("actives", window.d3up.gameData.actives[state['class']], 'poison-dart~b'),
						reset = $('<button class="btn btn-danger">Reset</button>');
				reset.bind('click', function() {
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
						if (options.length == 0)
							return 'No Skills Selected<b class="caret"></b>';
						else
							return options.length + ' selected  <b class="caret"></b>';
					}
				});
				
			}
		},
		update: function () {
			var container = this.options.container;
			// Remove the Previous Results
			container.empty();
			var row = $("<tr>");
			row.append($("<td colspan='100' class='loading'>").html("Loading"));
			container.append(row);
			// Grab the State Information
			var state = History.getState();		
			if(!state.data['battlenet']) {
				this._showBattlenetSearch();
			}	else {
				this._showD3UpcomSearch();
			}
			// Update the Filters to match the state
			$.each(state.data, function(k,v) {
				// Never pass a null value, this ensures it.
				if(v == null || v == 'null') {
					delete state.data[k];
					return;
				}
				// Update any filters to match what's in the state data
				var el = $("#d3up_buildBrowser_" + k);
				if(el) {
					// Need special actions on actives
					if(k == 'actives') {
						if(v != null) {
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
				jsonpCallback: 'd3up_bb_process',
			})
			// When the request completes, process the data
			.done($.proxy(this, 'process'));
		},
		_buildColumnHeaders: function() {
			var filters = this.options.filters,
					columns = this.options.columns,
					tr = $("<tr>");
			$.each(columns, function(k,v) {
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
					state = History.getState(),
					$this = this;
			// Store the Results on the browser
			this.results = data;
			// No results? Return the row telling the user
			if($.isEmptyObject(data)) {
				var row = $("<tr>"),
						cell = $("<td colspan='100'>"),
						content = $("<div class='alert alert-danger'>");
				content.append($("<h3>").append("No Builds Found."));
				row.append(cell.html(content));
				container.append(row);
				$(".btn.next").hide();
				return;
			}
			// Did we get an error back?
			if(data['error']) {
				var row = $("<tr>"),
						cell = $("<td colspan='100'>");
				row.append(cell.html(data['error']));
				container.append(row);
				return;				
			}
			// Iterate through our results and add new rows
			$.each(data, function(id, data) {
				var row = $("<tr>");
				$.each($this.options.columns, function(idx, col) {
					switch(col) {
						case "icon":
							row.append($this.makeColumn(col, [data.heroClass, data.gender]));
							break;
						case "region_type":
							var region = $this.d3.regions[data['bt-rg']]['short'];
							row.append($this.makeColumn(col, [region, data['hardcore']]));
							break;
						case "actives":
							if(data.actives)
								row.append($this.makeColumn(col, [data.heroClass, data.actives]));								
							break;
						case "passives":
							if(data.passives)
								row.append($this.makeColumn(col, [data.heroClass, data.passives]));
							break;
						case "level":
						case "paragon":
							row.append($this.makeColumn(col, [data[col], data.id]));
							break;
						default:
							if(data[col])
								row.append($this.makeColumn(col, [data[col], data.id, data]));
							break;
					}
				});
				if(data['exists'] == false) {
					var create = $("<a class='btn pull-right'>").html("Create New Build"),
							info = "This build was found on Battle.net, you can import it here:";
					// Build one big ol' query string!
					var qs = "character-bt=" + data['bt-tag'].replace("#", "-")
									+"&character-rg=" + data['bt-rg']
									+"&character-id=" + data['bt-id']
									+"&name=" + data['name']
									+"&class=" + data['heroClass']
									+"&hardcore=" + data['hardcore']
									+"&level=" + data['level']
									+"&paragon=" + data['paragon'];
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
					td = $("<td>");
			td.addClass("d_" + name);
			switch(name) {
				case "icon":
					td.html($this.classIcon(data[0], data[1]));
					break;
				case "region_type":
					var container = $("<span>")
					container.attr({
						'data-toggle': 'popover',
						'data-title': 'Region & Character Type',
					});
					if(data[1]) {
						container.attr({
							'data-content': 'This is a Hardcore character being played in the ' + data[0] + ' region.',							
						});
						container.html(data[0] + "/HD");						
					} else {						
						container.attr({
							'data-content': 'This is a Softcore character being played in the ' + data[0] + ' region.',							
						});
						container.html(data[0] + "/SC");
					}
					td.append(container);
					break;
				case "actives":
					$.each(data[1], function(k,v) { 
						var icon = $this.skillIcon(data[0], v);
						td.append(Handlebars.helpers.skillIcon.apply(icon, [data[0], v]).string);
					});
					break;
				case "passives":
					$.each(data[1], function(k,v) { 
						var icon = $this.passiveIcon(data[0], v);
						td.append(Handlebars.helpers.passiveIcon.apply(icon, [data[0], v]).string);
					});
					break;
				case "name":
					if(data[1]) {
						var date = new Date(data[2].updated * 1000),
								iso = date.toISOString(),
								link = $("<a href='/b/" + data[1] + "'>" + data[0] + "</a>"),
								updated = $("<span class='updated'>");
						updated.attr("title", iso);
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
			var heroClass = heroClass.replace("-", ""),
					urlTemplate = 'http://media.blizzard.com/d3/icons/portraits/42/|heroClass|_|gender|.png',
					url = urlTemplate.replace("|gender|", gender).replace("|heroClass|", heroClass);					
			return $("<img src='" + url + "'>");
		},
		_hover: function() {
			// Methods with an underscore are "private"
		},
		_setOption: function( key, value ) {
			// Use the _setOption method to respond to changes to options
			switch( key ) {
				case "length":
				break;
			}
			// and call the parent function too!
			return this._superApply( arguments );
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