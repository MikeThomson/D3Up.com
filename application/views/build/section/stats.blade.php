<?
	// Which tabs should collapse if it's a build?
	$collapse = array(
		'resistance',
		'ehp',
	);
	// Did we get passed an ID? If not, set it to null
	if(!isset($id)) {
		$id = null;
	}
	// Is this tab a compare?
	$isCompare = ($id == 'compare');
	// Set the Name Affix of the Tab
	$name = null;
	if($id && $id != 'compare' && isset($build)) {
		$name = "(".$build->name.")";
	} elseif($isCompare) {
		$name = __('build.compare');
	}
?>
<div class="build-stats" data-id="stats-sidebar{{ (($id) ? ('-'.$id) : "") }}">
	<script id="stats-sidebar{{ (($id) ? ('-'.$id) : "") }}" type="text/x-handlebars-template">
	
		{{-- Highlight: Used to highlight DPS/EHP and other major stats at the top. --}}
		@include('build.section.stats.highlight')

		{{-- Damage Stats: Used to display raw damage and DPS numbers, nothing weapon or skill specific. --}}
		@include('build.section.stats.damage')

		{{-- Base Stats: Base stats like Str, Dex, etc --}}
		@include('build.section.stats.base')

		{{-- Defensive Stats: Summary of Defensive Stats --}}
		@include('build.section.stats.defensive')

		{{-- Resistances: Specific Resistances --}}
		@include('build.section.stats.resistances')

		{{-- EHP: Specific versions of all your EHP --}}
		@include('build.section.stats.ehp')

		{{-- Health Stats: Summary of Health and Regen Mechanics --}}
		@include('build.section.stats.health')

	</script>
</div>
