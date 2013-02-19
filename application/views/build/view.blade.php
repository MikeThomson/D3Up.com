@layout('template.main')

@section('content')
@include('build.section.header')
<div class='row build-container'>
	<div class='span9'>
		<div class="tabbable tabs-left">
			<ul class="nav nav-tabs">
	      <li class='divider'>Build</li>
	      <li class='active'><a data-toggle="tab" href="#tab-gear">Gear</a></a></li>
	      <li><a data-toggle="tab" href="#tab-skills">Skills</a></li>
	      <li><a data-toggle="tab" href="#tab-buffs">Buffs</a></li>
	      <li><a data-toggle="tab" href="#tab-edit">Edit</a></li>
	      <li class='divider'>Tools</li>
	      <li><a data-toggle="tab" href="#tab-sync">Battle.net Sync</a></li>
	      <li><a data-toggle="tab" href="#tab-json">JSON Export</a></li>
	      <li class='divider'>Meta</li>
	      <li><a data-toggle="tab" href="#tab-math">Formulas</a></li>
				<li><a data-toggle="tab" href="#tab-groups">Groups</a></a></li>
			</ul>
			<div class="tab-content">
				<div class='tab-pane active' id="tab-gear">
					@include('build.section.gear')
				</div>
				<div class='tab-pane' id="tab-groups">
					@include('build.section.groups')
				</div>
				<div class='tab-pane' id="tab-skills">
					@include('build.section.skills')
				</div>
				<div class='tab-pane' id="tab-buffs">
					@include('build.section.buffs')
				</div>
				<div class='tab-pane' id="tab-edit">
					@include('build.section.edit')
				</div>
				<div class='tab-pane' id="tab-sync">
					@include('build.section.sync')
				</div>
				<div class='tab-pane' id="tab-json">
					@include('build.section.json')
				</div>
				<div class='tab-pane' id="tab-math">
					@include('build.section.math')
				</div>
				<div class='tab-pane' id="tab-share">
					@include('build.section.share')
				</div>
		  </div>
		</div>
	</div>
	<div class='span3'>
		@include('build.section.stats')
	</div>
</div>
<script>
	jQuery(document).ready(function ($) {
      $('#build-tabs').tab();
  });
</script>
@endsection