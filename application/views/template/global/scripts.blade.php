<!-- Bootstrap/Core Scripts -->
{{ HTML::scripts() }}
<script src="http://us.battle.net/d3/static/js/tooltips.js"></script>
<script type="text/javascript" charset="utf-8">
$(function(){
	/* 
		Hash Change behaviour and Tabbing
	*/
	// Store the Hash
  var hash = window.location.hash;
	// Store the Active tab and show it
	var active = $('ul.nav a[href="' + hash + '"]').tab('show');
	// Loop through parent elements to see if we're inside another tab
	$.each(active.parents('.tab-pane'), function() {
		// Activate the Parent Tab as well if it's a subtab
		$('ul.nav a[href="#' + $(this).attr("id") + '"]').tab('show');
		window.scrollTo(0, 0);
	});
	// Bind the Click function to change the Hash
  $('.nav-tabs a, .nav-pills a').click(function (e) {
    var scrollmem = $('body').scrollTop();
    window.location.hash = this.hash;
		// Scroll to the Top
    $('body').scrollTop(scrollmem);
		// Show the Tab
    $(this).tab('show');
  });
	// Scroll to the Top
	window.scrollTo(0, 0);
	// Add Toggle Icons swapping onto Accordions
	$('.accordion-group').on('show hide', function (n) {
    $(n.target).siblings('.accordion-heading').find('.accordion-toggle i').toggleClass('icon-chevron-right icon-chevron-down');
	});
	/*
		Since I couldn't get the search to jive with the # in battletags, I decided
		to create a hidden field that's submitted instead with a "-" instead of a "#".
		
		It basically allows users to put a dash or hash in the battletag, but always
		uses the dashes while submitting and in the API requests. 
	*/
	var form = $("#btsearch"), 
			hidden = form.find("input[name=battletag]"),
			input = $("input[name=battletag-display]");
	if(hidden.length && input.length) {
		// If our hidden field has a value, put it in the displayed
		input.val(hidden.val().replace("-", "#"));
		// While we're typing on Input, update the Hidden submitted value
		input.on("keyup", function(e) {
			hidden.val(input.val().replace("#", "-"));
			// If enter's pressed, submit the real form
			if(e.keyCode == 13) {
				form.submit();			
			} 
		});		
	}
});
</script>
<!-- The D3Up Tooltip Div -->
<div id="d3up-tooltip"></div>
<div id="d3up-tooltip-compare"></div>
@yield('scripts')