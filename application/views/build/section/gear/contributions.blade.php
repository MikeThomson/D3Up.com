<table id='build-contributions' class='table gear-table'>
	<thead>
		<tr>
			<th></th>
			<th>Name</th>
			<th>DPS Contribution</th>
			<th>EHP Contribution</th>
		</tr>
	</thead>
	<tbody>
		@foreach($build->gear->getSlots() as $slot) 
			<tr class='item'>
				<td>{{ HTML::itemBoxIcon($build->gear[$slot]) }}</td>
				<td>{{ HTML::itemLink($build->gear[$slot], array('toggle' => true, 'slot' => $slot)) }}</td>
				<td>{{ HTML::hb('round stats.dps-'.$slot.' 2') }}</td>
				<td>{{ HTML::hb('round stats.ehp-'.$slot.' 2') }}</td>
			</tr>
		@endforeach
	</tbody>
</table>