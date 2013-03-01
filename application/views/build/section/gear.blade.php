<?

?>
<style type="text/css" media="screen">

</style>
<div>
  <ul class="nav nav-tabs">
    <li>
			<a href="#gear-paperdoll" data-toggle="tab">Paperdoll</a>
		</li>
    <li class="active">
			<a href="#gear-overview" data-toggle="tab">Overview</a>
		</li>
    <li><a href="#gear-contributions" data-toggle="tab">DPS/EHP Contributions</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="gear-overview">
			<div>
				<div class='tab-content'>
					@foreach($build->gear as $item) 
						@if($item && $item->id)
							{{ View::make('build.section.item')->with('item', $item) }}
						@endif
					@endforeach
				</div>
				<table id='build-gear'>
					@foreach($build->gear->getSlots() as $slot) 
						<tr class='item'>
							<td>{{ HTML::itemBoxIcon($build->gear[$slot]) }}</td>
							<td>{{ HTML::itemLink($build->gear[$slot], array('toggle' => true, 'slot' => $slot)) }}</td>
						</tr>
					@endforeach
				</table>
			</div>
    </div>
    <div class="tab-pane" id="gear-contributions">
			Contributions
    </div>
    <div class="tab-pane" id="gear-paperdoll">
			<img src="http://placehold.it/500x400&text=Full Paper Doll for Character, like Battle.net">
    </div>
  </div>
</div>
<script type="text/javascript" charset="utf-8">
	$('#gear-overview a[data-toggle="tab"]').on('show', function (e) {
		$("#d3up-tooltip").empty();
		$('#gear-overview .nav').hide();
		$('#gear-overview .return-home').bind('click', function() {
			$(this).closest('.item-detail').removeClass("active");
			$('#gear-overview .nav').show();
		});
		// console.log(e.target);
	})
</script>