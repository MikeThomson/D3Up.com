<!-- Bootstrap/Core Scripts -->
<script src="/js/jquery.js"></script>
<script src="/js/jquery-ui.js"></script>
<script src="/js/underscore.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/handlebars.js"></script>
<script src="/js/utils/handlebars.helpers.js"></script>
<!-- Battle.net Scripts -->
<script src="http://us.battle.net/d3/static/js/tooltips.js"></script>
<!-- D3Up Scripts -->
<script src="/js/d3up.js"></script>
<script src="/js/utils/tooltip.js"></script>
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
	});
	// Scroll to the Top
  $('html').scrollTop();
	// Bind the Click function to change the Hash
  $('.nav-tabs a, .nav-pills a').click(function (e) {
    var scrollmem = $('body').scrollTop();
    window.location.hash = this.hash;
		// Scroll to the Top
    $('body').scrollTop(scrollmem);
		// Show the Tab
    $(this).tab('show');
  });
});
</script>
<!-- The D3Up Tooltip Div -->
<div id="d3up-tooltip"></div>
<div id="d3up-tooltip-compare"></div>
@yield('scripts')