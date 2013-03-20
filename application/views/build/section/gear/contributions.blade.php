<div class='d3up-helper'>
	<h3>DPS and EHP Contributions</h3>
	<p>The contributions towards your DPS and EHP for each piece of gear. Wondering how it's calculated? <a href="#">DPS and EHP Contributions Explained</a>.</p>
</div>
<table id='build-contributions' class='table gear-table'>
	<thead>
		<tr>
			<th></th>
			<th>Name</th>
			<th>DPS</th>
			<th>DPS%</th>
			<th>EHP</th>
			<th>EHP%</th>
		</tr>
	</thead>
	<tbody>
		@foreach($build->gear->getSlots() as $slot) 
			<tr class='item'>
				<td>{{ HTML::itemBoxIcon($build->gear[$slot]) }}</td>
				<td>{{ HTML::itemLink($build->gear[$slot], array('toggle' => true, 'slot' => $slot)) }}</td>
				<td>{{ HTML::hb('round stats.dps-'.$slot.' 2') }}</td>
				<td>{{ HTML::hb('percent stats.dps-'.$slot.' stats.dps-gear-total') }}%</td>
				<td>{{ HTML::hb('round stats.ehp-'.$slot.' 2') }}</td>
				<td>{{ HTML::hb('percent stats.dps-'.$slot.' stats.dps-gear-total') }}%</td>
			</tr>
		@endforeach
	</tbody>
</table>