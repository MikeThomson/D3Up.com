function getParameterByName(name, defaultValue) {
	name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
	var regexS = "[\\?&]" + name + "=([^&#]*)";
	var regex = new RegExp(regexS);
	var results = regex.exec(window.location.search);
	if(results == null && defaultValue)
		return defaultValue;
	else if(results == null)
		return "";
	else
		return decodeURIComponent(results[1].replace(/\+/g, " "));
}
(function($) {
	$.widget( "d3up.buildBrowser", {
		results: {},
		d3: {
			classes: [
				'barbarian', 
				'demon-hunter', 
				'monk', 
				'witch-doctor', 
				'wizard'
			],
		},
		options: {
			filters: false,
			container: false,
			paginators: [],
		},
		_create: function() {
			// Set the Current State with whatever the URL Parameters are set to
			History.replaceState({
				'page': getParameterByName('page', 1),
				'class': getParameterByName('class', "")
			});
			// Bind the window statechange event to our update method
			this._on(window, { statechange: "update" });
			// Create the Class Filter
			this._createFilters();
			// Create the Paginators
			this._createPaginators();
			// Run update immediately to populate default data
			this.updateFromState();
		},
		_createPaginators: function() {
			// Create our paginator html elements
		},
		_createFilter: function(name, options, defaultValue) {
			// Store this as browser
			var browser = this,
					// Create the Select Element 
					select = $("<select name='" + name + "' id='d3up_buildBrowser_" + name + "'>");
			// Each option we're passed, make into a HTML element
			$.each(options, function(k,v) {
				// Define the HTML Element and append
				select.append($("<option value='" + k + "'>" + v + "</option>"));
			});
			// Bind the Change event to push the modified state to History
			select.on('change', function() {
				// Grab a copy of the state's data
				var state = History.getState().data;
				// Modify the Value we're changing
				state[name] = $(this).val();
				// Push the Updates to History
				History.pushState(state, "", "?" + $.param(state));
			});
			return select;
		},
		_createFilters: function() {
			var wrapper = $("<tr class='filters'>"),
					container = $("<td>");
			// Build the Class Selector
			var options = {
				null: 'All Classes'
			};
			// Iterate over classes and build the params for _createSelect
			$.each(this.d3.classes, function(k,v) {
				var name = v.split("-").join(" ");
				options[v] = name;
			});
			// Build the Select and append it to the container
			container.append(this._createFilter("class", options, this.options.heroClass));
			// Append the Container to the Wrapper
			wrapper.html(container);
			// Then finally add it into the filters
			this.options.filters.append(wrapper);
		},
		updateFromState: function() {
			this.update();
		},
		update: function () {
			// Grab the State Information
			var state = History.getState();
			// Update the Filters to match the state
			$.each(state.data, function(k,v) {
				var el = $("#d3up_buildBrowser_" + k);
				if(el) {
					el.val(v);
				}
			});
			// Perform the API call with the state data
			$.ajax({
				url: 'http://api.d3up.com/builds',
				data: state.data,
				dataType: 'jsonp'
			})
			// When the request completes, process the data
			.done($.proxy(this, 'process'));
		},
		process: function(data) {
			// Store the Results on the browser
			this.results = data;
			// Grab the Container 
			var container = this.options.container;
			// Remove the Previous Results
			container.empty();
			// Iterate through our results and add new rows
			$.each(data, function(id,data) {
				var row = $("<tr>");
				row.append($("<td>").html(data.name));
				row.append($("<td>").html(data.level));
				row.append($("<td>").html(data.paragon));
				row.append($("<td>").html(data.heroClass));
				if(data.actives) {
					row.append($("<td>").html(data.actives.join(" ")));							
				}
				if(data.passives) {
					row.append($("<td>").html(data.passives.join(" ")));														
				}
				container.append(row);
			});
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
	});
})( jQuery );