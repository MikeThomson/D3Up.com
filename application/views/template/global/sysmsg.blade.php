<div id="sysmsg" class="alert alert-error" data-timestamp="<?= filemtime($this->path) ?>">
	<a class="close" data-dismiss="alert" href="#">&times;</a>
	<strong>Broadcast (<?= date(DATE_RFC822, filemtime($this->path)) ?>)</strong>: This is a developmental version of D3Up.com V2, MANY things don't work. 
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