<script type="text/javascript" charset="utf-8">
	$(function() {
		var controls = $("nav[data-role=tabs] a"),
				tabs = $("div[data-role=tab]");
		// Hide Tabs
		tabs.not(":first").hide();
		// Do we have a hash?
		if(window.location.hash) {
			tabs.hide();
			controls.each(function() {
			  $(this).removeClass("active");
			  if($(this).data("tab") == window.location.hash) {
			    $(this).addClass("active");
			  }
			});
			$("div[data-role=tab]" + window.location.hash).show();
		}
		// Bind our click event
		controls.on('click', function(e) {
			// Hide Tabs
			tabs.hide();
			var top =document.body.scrollTop;
			// Change the URL to add the hash
			location.hash = $(this).data("tab");
			// Scroll back to top
			document.body.scrollTop = top;
			// Remove the 'Active' Class on controls
			controls.removeClass("active");
			// Add it to what we clicked
			$(this).addClass("active");
			// Show correct tab
			$("div[data-role=tab]" + $(this).data("tab")).show();
			// Prevent Defaults
			e.preventDefault();
			return false;
		});
	});
</script>