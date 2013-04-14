@layout('template.main')

@section('styles')
<link href="/css/build.css" rel="stylesheet">
<link href="/css/compare.css" rel="stylesheet">
<link href="/css/paperdoll.css" rel="stylesheet">
<link href="/css/utils/chosen.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="http://d3up.com/js/gamedata.js"></script>
<script src="/js/build.js"></script>
<script src="/js/utils/compare.js"></script>
<script src="http://d3up.com/js/unmin/calcv2.js"></script>
<script src="http://d3up.com/js/unmin/itembuilder.js"></script>
<script src="/js/utils/chosen.min.js"></script>
@endsection

@section('content')
@include('build.section.header')
<div class='row build-container'>
	<div class="build-content span9 tabbable tabs-left">
		<ul class="nav nav-tabs">
      <li class='divider'>{{ __('build.build') }}</li>
      <li class='active'><a data-toggle="tab" href="#tab-gear">{{ __('build.gear') }}</a></a></li>
      <li><a data-toggle="tab" href="#tab-skills">{{ __('build.skills') }}</a></li>
      <li><a data-toggle="tab" href="#tab-buffs">{{ __('build.buffs') }}</a></li>
      <li><a data-toggle="tab" href="#tab-edit">{{ __('build.edit') }}</a></li>
      <li class='divider'>{{ __('build.tools') }}</li>
      <li><a data-toggle="tab" href="#tab-sync">{{ __('build.battlenet_sync') }}</a></li>
      <li><a data-toggle="tab" href="#tab-json">{{ __('build.json_export') }}</a></li>
      <li class='divider'>{{ __('build.meta') }}</li>
      <li><a data-toggle="tab" href="#tab-math">{{ __('build.formulas') }}</a></li>
			<li><a data-toggle="tab" href="#tab-groups">{{ __('build.groups') }}</a></a></li>
		</ul>
		<div class="tab-content">
			<div class='tab-pane active' id="tab-gear">
				@render('build.section.gear', array('gear' => $build->getGear()))
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
	<div class='span3'>
		@include('build.section.stats')
	</div>
</div>
<div id='character' data-json='{{ $build->json() }}'></div>
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

	<?= (isset($_GET['debug'])) ? 'console.log(d3up.builds.primary);' : ''; ?>

	var sources = [
		'#gear-overview table tbody',
		'#gear-contributions table tbody',
		'#stats-sidebar',
		'#skill-overview',
		'#dps-math',
	];
	
	$.each(sources, function(k,v) {
		var source   = $(v).html();
		var template = Handlebars.compile(source);
		var data = d3up.builds.primary;
		$(v).replaceWith(template(data));		
	});
	
	$(function() {
		var analyzer = $("#pdanalyzer"),
				container = $(".pdanalyzer"),
				results = container.find('.pdanalyzer-results'),
				paperdoll = analyzer.closest("#gear-paperdoll").find(".paperdoll");
				builder = new d3up.ItemBuilder();
		$.each(builder.skillText, function(k,v) {
			var option = $("<option>");
			// Replace my placeholder value with X
			option.html(v.replace("VVV", "X"));
			// Append the Value
			option.attr("value", k);
			// Add it to the Analyzer
			analyzer.append(option);
		});
		// Activate Chosen on the Select
		analyzer.chosen();
		paperdoll.find("a[data-json]").on('click', function(e) {
			var	json = $(this).data('json'),
					toFilter = Object.keys(json.attrs);
			analyzer.val(toFilter).trigger('change').trigger("liszt:updated");
			return false;
		});
		// Bind to it's change event
		analyzer.on('change', function(){
			var filters = $(this).val();
			// Empty out old Results
			results.empty();
			// Loop through the Paperdoll's Items
			paperdoll.find("li").each(function() {
				// If we don't have filters anymore, reset
				if(!filters) {
					$(this).css({opacity: 1});
					return;
				}
				var $this = $(this),
						slot = $(this).attr("class").replace("slot-", ""),
						item = $(this).find("a[data-json]").data("json"),
						intersected = _.intersection(Object.keys(item.attrs), filters);
				// Highlight the Items that have all filtered values
				if(intersected.length == filters.length) {
					// Set Opacity to Full
					$this.css({opacity: 1});
					var itemLink = $("<a>"),
							entry = $("<li>"),
							attrs = $("<ul>");
					// Build the Link for the Item
					itemLink.addClass("quality-" + item.quality);
					itemLink.attr("href", $(this).find("a").attr("href"));
					itemLink.html(item.name);
					entry.append(itemLink);
					$.each(intersected, function(k,v) {
						var attr = $("<li>");
						attr.html(v + " " + item.attrs[v]);
						attrs.append(attr);
					});
					if(attrs) {
						results.append(entry.append(attrs));						
					}
				} else {
					// Half the Opacity
					$this.css({opacity: 0.5});
				}
			})
		});
	});
</script>
@endsection