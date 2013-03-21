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
			<table class='table stat-table'>
				@foreach($stats as $stat)
				<tr>
					@if($id != 'compare')
					<td>{{ __('diablo.'.$stat) }}</td>
					@endif
					<td>
						{{ HTML::hb('#if_gt victor.'.$stat.' compare=0') }}<span class='victor-{{ HTML::hb('victor.'.$stat) }}'></span>{{ HTML::hb('/if_gt') }}
						@if($id == 'compare')
							{{ HTML::hb('#if_gt stats.'.$stat.' compare=0') }}+{{ HTML::hb('/if_gt') }}
						@endif
						{{ HTML::hb('round stats.'.$stat.' 4') }}
					</td>
				</tr>
				@endforeach
			</table>
    </div>
  </div>
</div>