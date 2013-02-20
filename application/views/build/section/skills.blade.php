<div>
  <ul class="breadcrumb">
    <li><a href="#skills-overview" data-toggle="tab">Overview</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="gear-overview">
			Overview
			<p><img src="http://placehold.it/500x100&text=Skill #1"></p>
			<p><img src="http://placehold.it/500x100&text=Skill #2"></p>
			<p><img src="http://placehold.it/500x100&text=Skill #3"></p>
			<p><img src="http://placehold.it/500x100&text=Skill #4"></p>
			<p><img src="http://placehold.it/500x100&text=Skill #5"></p>
			<p><img src="http://placehold.it/500x100&text=Skill #6"></p>
    </div>
    <div class="tab-pane" id="gear-contributions">
			Contributions
    </div>
  </div>
</div>
<script type="text/javascript" charset="utf-8">
	$('#gear-overview a[data-toggle="tab"]').on('show', function (e) {
		$('#gear-overview .nav').hide();
		$('#gear-overview .return-home').bind('click', function() {
			$(this).closest('.item-detail').removeClass("active");
			$('#gear-overview .nav').show();
		});
		// console.log(e.target);
	})
</script>