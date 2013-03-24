<?

?>
<style type="text/css" media="screen">

</style>
<div>
  <ul class="nav nav-pills">
    <li>
			<a href="#gear-paperdoll" data-toggle="tab">{{ __('build.paperdoll') }}</a>
		</li>
    <li class="active">
			<a href="#gear-overview" data-toggle="tab">
				{{ __('build.overview') }}
			</a>
		</li>
    <li>
			<a href="#gear-contributions" data-toggle="tab">{{ __('build.dps_ehp_contributions') }}</a>
		</li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane" id="gear-overview">
			@include("build.section.gear.overview")
    </div>
    <div class="tab-pane" id="gear-contributions">
			@include("build.section.gear.contributions")
    </div>
    <div class="tab-pane active" id="gear-paperdoll">
			@include("build.section.gear.paperdoll")
    </div>
  </div>
</div>
<script type="text/javascript" charset="utf-8">
	$('#gear-overview a[data-toggle="tab"]').on('show', function (e) {
		$("#d3up-tooltip").empty();
		$('#gear-overview .nav').hide();
		$('#gear-overview .return-home').bind('click', function() {
			$(this).closest('.item-detail').removeClass("active");
			$('#gear-overview .nav').show();
		});
		// console.log(e.target);
	})
</script>