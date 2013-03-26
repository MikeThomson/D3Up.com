<?
if(!isset($compare)) {
	$compare = false;
}
?>
<div>
	<div class='tab-content'>
		@foreach($gear as $item) 
			@if($item && $item->id)
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
			@foreach($gear->getSlots() as $slot) 
				<tr class='item'>
					<td>{{ HTML::itemBoxIcon($gear[$slot]) }}</td>
					<td>{{ HTML::itemLink($gear[$slot], array('toggle' => true, 'slot' => $slot, 'compare' => $compare)) }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>