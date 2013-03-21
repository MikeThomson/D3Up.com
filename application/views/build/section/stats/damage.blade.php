<?
	$stats = array(
		'dps',
		'dps-demon',
		'dps-elite',
		'aps-mh',
		'aps-oh',
		'attack-speed-incs',
		'critical-hit',
		'critical-hit-damage',
	);
?>
<div class="accordion-group">
  <div class="accordion-heading">
    <a class="accordion-toggle" data-toggle="collapse" href=".collapseDamage">
			@if(!$isCompare)
			{{ (isset($name)) ? $name : "" }}
			@else
				{{ __('diablo.damage_statistics') }}
				{{ (isset($name)) ? $name : "" }}
			@endif				
    </a>
  </div>
  <div class="collapseDamage accordion-body collapse in">
    <div class="accordion-inner">
			@include('build.section.stats.table')
    </div>
  </div>
</div>