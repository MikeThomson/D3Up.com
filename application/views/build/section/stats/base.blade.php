<?
	$stats = array(
		'strength',
		'dexterity',
		'intelligence',
		'vitality',
		'plus-magic-find',
		'plus-gold-find',
		'plus-movement'
	);
?>
<div class="accordion-group">
  <div class="accordion-heading">
    <a class="accordion-toggle" data-toggle="collapse" href=".collapseBase">
			@if(!$isCompare)
			{{ (isset($name)) ? $name : "" }}
			@else
				{{ __('diablo.base_statistics') }}
				{{ (isset($name)) ? $name : "" }}
			@endif				
    </a>
  </div>
  <div class="collapseBase accordion-body collapse in">
    <div class="accordion-inner">
			@include('build.section.stats.table')
    </div>
  </div>
</div>