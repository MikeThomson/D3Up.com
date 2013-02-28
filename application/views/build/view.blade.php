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
<div id='character' data-json='{{ $build->json() }}'/>
<script>
	jQuery(document).ready(function ($) {
		$('#build-tabs').tab();
  });
	// Setup the Build and Calculators
  var build = $("#character").data("json"),
			// Set the Skills Used
			skills = {
        actives: build.actives,
        passives: build.passives
      },
			// Grab all the gear
      gear = $("#build-gear a[data-json]"),
			// Set Meta information about the character
      meta = {
        level: build.level,
        paragon: build.paragon,
        heroClass: build.heroClass,
      },
			// Set the Gear, Skills and Meta on the Primary Build
      buildPrimary = new d3up.Build({
        gear: gear, 
        skills: skills,
        meta: meta
      }),
			// Set the Gear, Skills and Meta on the Compare Build
      buildCompare = new d3up.Build({
        gear: gear, 
        skills: skills,
        meta: meta
      });
	// Store the Primary and Compare builds
  d3up.builds = {
    primary: buildPrimary,
    compare: buildCompare
  };
	// Run stats against the primary build
	d3up.builds.primary.run();
	// console.log(d3up.builds.primary);
  // d3up.compare = compare;
  // Render build to Statistics Panels
  // build.renderTo($("#statistics"));
  // build.renderTo($("#dps-math"));
  // Render build to a few of the Gear tabs
  // build.renderTo($("#gear"));
  // Render the Skills into the Skills Tab
  // build.renderSkillsTo($("#skills"));
  // build.renderSkillsTo($("#passives"));
  // build.renderSkillsTo($("#buffs"));
  // build.renderSkillsTo($("#group-buffs"));
  // Render the Skills and Data to the Header
  // build.renderSkillsTo($("#build-header"));
  // build.renderSkillCatalog($("#skill-catalog"));

</script>
@endsection