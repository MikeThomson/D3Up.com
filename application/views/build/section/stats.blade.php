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
<div id="build-gear-results">
	<div class="results build-stats"></div>
	<script id="build-gear-results-template" type="text/x-handlebars-template">
		<table class='table stat-table'>
			{{ HTML::hb('#each this.diff') }}
				{{ HTML::hb('#unless_eq diff compare=0') }}
				<tr>
					<td>{{ HTML::hb("@key") }}</td>
					<td>{{ HTML::hb("prettyStat diff @key") }}</td>
					<td>{{ HTML::hb("prettyStat value2 @key") }}</td>
					<td>{{ HTML::hb("prettyStat value1 @key") }}</td>
				</tr>
				{{ HTML::hb('/unless_eq') }}
			{{ HTML::hb('/each')}}
		</table>
	</script>
</div>
<div class="build-stats" data-id="stats-sidebar{{ (($id) ? ('-'.$id) : "") }}">
	<script id="stats-sidebar{{ (($id) ? ('-'.$id) : "") }}" type="text/x-handlebars-template">

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
