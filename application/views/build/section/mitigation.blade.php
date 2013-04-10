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
<div class="build-stats" data-id="mitigation-sidebar{{ (($id) ? ('-'.$id) : "") }}">
	<script id="mitigation-sidebar{{ (($id) ? ('-'.$id) : "") }}" type="text/x-handlebars-template">
	
		@include('build.section.stats.mitigation-top')

		@include('build.section.stats.mitigation-bottom')

	</script>
</div>
