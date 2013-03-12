<div class="accordion-group">
  <div class="accordion-heading">
    <a class="accordion-toggle" data-toggle="collapse" href="#collapseBase">
			{{ __('diablo.base_statistics') }}
    </a>
  </div>
  <div id="collapseBase" class="accordion-body collapse in">
    <div class="accordion-inner">
			<table class='table stat-table'>
				<tr>
					<td>{{ __('diablo.strength') }}</td>
					<td>{{ HTML::hb('stats.strength') }}</td>
				</tr>
				<tr>
					<td>{{ __('diablo.dexterity') }}</td>
					<td>{{ HTML::hb('stats.dexterity') }}</td>
				</tr>
				<tr>
					<td>{{ __('diablo.intelligence') }}</td>
					<td>{{ HTML::hb('stats.intelligence') }}</td>
				</tr>
				<tr>
					<td>{{ __('diablo.vitality') }}</td>
					<td>{{ HTML::hb('stats.vitality') }}</td>
				</tr>
				<tr>
					<td>{{ __('diablo.magic_find') }}</td>
					<td>{{ HTML::hb('stats.plus-magic-find') }}</td>
				</tr>
				<tr>
					<td>{{ __('diablo.gold_find') }}</td>
					<td>{{ HTML::hb('stats.plus-gold-find') }}</td>
				</tr>
				<tr>
					<td>{{ __('diablo.movement_speed') }}</td>
					<td>{{ HTML::hb('stats.plus-movement') }}</td>
				</tr>
			</table>
    </div>
  </div>
</div>