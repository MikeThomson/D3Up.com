@layout('template.main')

@section('styles')
<link href="/css/build.css" rel="stylesheet">
<link href="/css/compare.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="http://d3up.com/js/gamedata.js"></script>
<script src="/js/build.js"></script>
<script src="http://d3up.com/js/unmin/calcv2.js"></script>
<script src="http://d3up.com/js/unmin/itembuilder.js"></script>
@endsection

@section('content')
<div class='row compare-container'>
	<div class='span6'>
		<div class="tab-content">
			@include('build.section.header')->with('build', $build1)
			<div class='tab-pane active' id="tab-gear">
				@include('build.section.gear.overview')->with('build', $build1)
			</div>
			<div class='tab-pane' id="tab-skills">
				@include('build.section.skills')->with('build', $build1)
			</div>
	  </div>
	</div>
	<div class='span6'>
		<div class="tab-content">
			@include('build.section.header')->with('build', $build2)
			<div class='tab-pane active' id="tab-gear">
				@include('build.section.gear.overview')->with('build', $build2)
			</div>
			<div class='tab-pane' id="tab-skills">
				@include('build.section.skills')->with('build', $build2)
			</div>
	  </div>
	</div>
</div>
<script>
	// jQuery(document).ready(function ($) {
	// 	$('#build-tabs').tab();
	//   });
	// // Setup the Build and Calculators
	//   var build = $("#character").data("json"),
	// 		// Set the Skills Used
	// 		skills = {
	//         actives: build.actives,
	//         passives: build.passives
	//       },
	// 		// Grab all the gear
	//       gear = $("#build-gear a[data-json]"),
	// 		// Set Meta information about the character
	//       meta = {
	//         level: build.level,
	//         paragon: build.paragon,
	//         heroClass: build.heroClass,
	//       },
	// 		// Set the Gear, Skills and Meta on the Primary Build
	//       buildPrimary = new d3up.Build({
	//         gear: gear, 
	//         skills: skills,
	//         meta: meta
	//       }),
	// 		// Set the Gear, Skills and Meta on the Compare Build
	//       buildCompare = new d3up.Build({
	//         gear: gear, 
	//         skills: skills,
	//         meta: meta
	//       });
	// // Store the Primary and Compare builds
	//   d3up.builds = {
	//     primary: buildPrimary,
	//     compare: buildCompare
	//   };
	// // Run stats against the primary build
	// d3up.builds.primary.run();
	// // console.log(d3up.builds.primary);
	//   // d3up.compare = compare;
	//   // Render build to Statistics Panels
	//   // build.renderTo($("#statistics"));
	//   // build.renderTo($("#dps-math"));
	//   // Render build to a few of the Gear tabs
	//   // build.renderTo($("#gear"));
	//   // Render the Skills into the Skills Tab
	//   // build.renderSkillsTo($("#skills"));
	//   // build.renderSkillsTo($("#passives"));
	//   // build.renderSkillsTo($("#buffs"));
	//   // build.renderSkillsTo($("#group-buffs"));
	//   // Render the Skills and Data to the Header
	//   // build.renderSkillsTo($("#build-header"));
	//   // build.renderSkillCatalog($("#skill-catalog"));
	// 
	// Handlebars.registerHelper('round', function(value, places) {
	// 	if(!places) {
	// 		return Math.round(value);
	// 	}
	// 	var exponent = Math.pow(10, places);
	// 	var num = Math.round((value * exponent)).toString();
	// 	return num.slice(0, -1 * places) + "." + num.slice(-1 * places)
	//   return Math.round(value * Math.pow());
	// });
	// 
	// var source   = $("#handlebar-stats").html();
	// var template = Handlebars.compile(source);
	// var data = d3up.builds.primary;
	// $("#handlebar-stats").replaceWith(template(data));

</script>
@endsection