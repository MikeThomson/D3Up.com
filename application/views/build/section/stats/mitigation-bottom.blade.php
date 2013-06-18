<?
	$stats = array(
		'armor',
		'armorReduction',
		'percent-resist-all',
		'damage-reduction',
		'life',
		'ehp.ehp',
	);
	// Only show the HP/EHP Ratio if we aren't comparing
	if(!$isCompare) {
		$stats[] = 'hp-ehp-ratio';
	}
	$tabName = false;
?>
@include("build.section.stats.table")