<div>
	<div class='tab-content'>
		@foreach($build->gear as $item) 
			@if($item && $item->id)
				{{ View::make('build.section.item')->with('item', $item) }}
			@endif
		@endforeach
	</div>
	<table id='build-gear' class='table gear-table'>
		<thead>
			<tr>
				<th></th>
				<th>Name</th>
			</tr>
		</thead>
		<tbody>
			@foreach($build->gear->getSlots() as $slot) 
				<tr class='item'>
					<td>{{ HTML::itemBoxIcon($build->gear[$slot]) }}</td>
					<td>{{ HTML::itemLink($build->gear[$slot], array('toggle' => true, 'slot' => $slot)) }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>