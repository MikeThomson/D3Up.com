@section('styles')
<link href="/css/build.css" rel="stylesheet">
<link href="/css/compare.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="http://d3up.com/js/gamedata.js"></script>
<script src="/js/build.js"></script>
<script src="/js/utils/compare.js"></script>
<script src="http://d3up.com/js/unmin/calcv2.js"></script>
<script src="http://d3up.com/js/unmin/itembuilder.js"></script>
@endsection

@section('content')
<div class='row compare-container tab-content'>
	<div class='span6' id="build-header-1">
		@include('build.section.header')->with('build', $build1)
	</div>
	<div class='span6' id="build-header-2">
		@include('build.section.header')->with('build', $build2)
	</div>
	<div class='span12'>
		<ul class="nav nav-pills">
	    <li class="active">
				<a href="#tab-stats" data-toggle="tab">{{ __('build.stats') }}</a>
			</li>
	    <li>
				<a href="#tab-gear" data-toggle="tab">{{ __('build.gear') }}</a>
			</li>
	    <li>
				<a href="#tab-skills" data-toggle="tab">{{ __('build.skills') }}</a>
			</li>
	    <li>
				<a href="#tab-mitigation" data-toggle="tab">{{ __('build.mitigation') }}</a>
			</li>
	  </ul>
	</div>
	<div class='tab-pane active' id="tab-stats">
		<div class='span5 build1-stats'>
			@include('build.section.stats')->with('build', $build1)->with('id', 1)
		</div>
		<div class='span2'>
			@include('build.section.stats')->with('id', 'compare')
		</div>
		<div class='span5 build2-stats'>
			@include('build.section.stats')->with('build', $build2)->with('id', 2)
		</div>
	</div>
	<div class='tab-pane' id="tab-gear">
		<div class='span6' id="build1-gear">
			@include('build.section.gear.overview', array('gear' => $build1->getGear(), 'compare' => true))
		</div>
		<div class='span6' id="build2-gear">
			@include('build.section.gear.overview', array('gear' => $build2->getGear(), 'compare' => true))
		</div>
	</div>
	<div class='tab-pane' id="tab-mitigation">
		<div class='span12'>
			@include('build.section.stats.mitigation-calc')
		</div>
		<div class='span5 build2-stats' id="build1-mitigation">
			@include('build.section.mitigation', array('build' => $build1, 'id' => 1))
		</div>
		<div class='span2'>
			@include('build.section.mitigation')->with('id', 'compare')
		</div>
		<div class='span5 build2-stats' id="build2-mitigation">
			@include('build.section.mitigation', array('build' => $build2, 'id' => 2))
		</div>
	</div>
	<div class='tab-pane' id="tab-skills">
		<div class="span6" id="build1-skills">
			@include('build.section.skills')->with('build', $build1)->with('compare', true)
		</div>
		<div class="span6" id="build2-skills">
			@include('build.section.skills')->with('build', $build2)->with('compare', true)
		</div>
	</div>
</div>
<div id='character1' data-json='{{ json_encode($build1->json()) }}'></div>
<div id='character2' data-json='{{ json_encode($build2->json()) }}'></div>
<script>
	// Build #1
	var data1 = $("#character1").data("json"),
			skills1 = {
	        actives: data1.actives,
	        passives: data1.passives
	      },
      gear1 = $("#build1-gear .gear-table a[data-json]"),
      meta1 = {
        level: data1.level,
        paragon: data1.paragon,
        heroClass: data1.heroClass,
      },
      build1 = new d3up.Build({
        gear: gear1, 
        skills: skills1,
        meta: meta1
      });
	// Build #2
	var data2 = $("#character2").data("json"),
			skills2 = {
	        actives: data2.actives,
	        passives: data2.passives
	      },
      gear2 = $("#build2-gear .gear-table a[data-json]"),
      meta2 = {
        level: data2.level,
        paragon: data2.paragon,
        heroClass: data2.heroClass,
      },
      build2 = new d3up.Build({
        gear: gear2, 
        skills: skills2,
        meta: meta2
      });	
	// Store the Builds
	d3up.builds = {
		build1: build1,
		build2: build2
	};
	// Run stats
	d3up.builds.build1.run();
	d3up.builds.build2.run();
	
	var source   = $("#stats-sidebar-1").html();
	var template = Handlebars.compile(source);
	var data = d3up.builds.build1;
	$("#stats-sidebar-1").replaceWith(template(data));		

	
	var source   = $("#build-header-1 .skill-row").html();
	var template = Handlebars.compile(source);
	var data = d3up.builds.build1;
	$("#build-header-1 .skill-row").replaceWith(template(data));				

	var source   = $("#build-header-2 .skill-row").html();
	var template = Handlebars.compile(source);
	var data = d3up.builds.build2;
	$("#build-header-2 .skill-row").replaceWith(template(data));				


	var source   = $("#stats-sidebar-2").html();
	var template = Handlebars.compile(source);
	var data = d3up.builds.build2;
	$("#stats-sidebar-2").replaceWith(template(data));		
	
	var compare = new d3up.Compare;
	var diff = compare.diff(build1, build2);

	var source   = $("#stats-sidebar-compare").html();
	var template = Handlebars.compile(source);
	var data = diff;
	$("#stats-sidebar-compare").replaceWith(template(data));

	var source   = $("#mitigation-sidebar-compare").html();
	var template = Handlebars.compile(source);
	var data = diff;
	$("#mitigation-sidebar-compare").replaceWith(template(data));

	var source   = $("#build1-skills #skill-overview").html();
	var template = Handlebars.compile(source);
	var data = d3up.builds.build1;
	$("#build1-skills .tab-content").replaceWith(template(data));		
	
	var source   = $("#build2-skills #skill-overview").html();
	var template = Handlebars.compile(source);
	var data = d3up.builds.build2;
	$("#build2-skills .tab-content").replaceWith(template(data));		

	var source   = $("#mitigation-sidebar-1").html();
	var template = Handlebars.compile(source);
	var data = d3up.builds.build1;
	$("#mitigation-sidebar-1").replaceWith(template(data));		

	var source   = $("#mitigation-sidebar-2").html();
	var template = Handlebars.compile(source);
	var data = d3up.builds.build2;
	$("#mitigation-sidebar-2").replaceWith(template(data));		

	
	<?= (isset($_GET['debug'])) ? 'console.log(d3up.builds);' : ''; ?>
	
	
</script>
@endsection