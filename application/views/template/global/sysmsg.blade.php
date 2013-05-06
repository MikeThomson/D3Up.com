<div id="sysmsg" class="alert alert-error" data-timestamp="<?= filemtime($this->path) ?>">
	<a class="close" data-dismiss="alert" href="#">&times;</a>
	<strong>Broadcast (<?= date(DATE_RFC822, filemtime($this->path)) ?>)</strong><br/>
	Welcome to the D3Up.com V2 Staging Server. All information here will be wiped regularly (including users), so don't get attached. Use the main site for regular calculations, and if your login stops working you'll have to register again. You can also close this message with the little X in the corner. 
</div>
<script>
	$(function() {
		var sysmsg = $("#sysmsg"),
				current = sysmsg.attr("data-timestamp"),
				closed = $.cookie("sysmsg-close");
		if(closed >= current) {
			sysmsg.hide();			
		} else {
			sysmsg.find(".close").bind('click', function() {
				$.cookie("sysmsg-close", current);
			});
		}
	});
</script>