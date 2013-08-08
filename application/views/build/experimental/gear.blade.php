<div class='row'>
	<div class='column_9'>
		<div class="build-gear">
			<div class='build-gear-modify'>
			</div>
			<script id="build-gear{{ ((isset($id)) ? ('-'.$id) : "") }}" type="text/x-handlebars-template">
				<table class='table table-gear no-margin'>
					<thead>
						<tr>
							<th>Name</th>
							<th>DPS Contribution</th>
							<th>EHP Contribution</th>
						</tr>
					</thead>
					<tbody>
						@foreach($build->gear as $slot => $item)
						<tr class='item'>
							<td>
								{{ HTML::itemIcon($item) }}
								{{ HTML::itemLink($item, array('slot' => $slot, 'icon' => true)) }}
								@if($item->_modified)
									<i class="item-modified icon-certificate" title="Modified Item"></i>
								@endif
								<i class="btn-modify icon-signout pull-right icon-border" data-modify-toggle="{{ $slot }}"></i>
							</td>
							<td>{{ HTML::hb('prettyStat stats.gear.'.$slot.'.contributions.dps') }}</td>
							<td>{{ HTML::hb('prettyStat stats.gear.'.$slot.'.contributions.ehp') }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</script>
		</div>
	</div>
	<div class="column_3">
		@include('build.section.stats')
	</div>
</div>
<script type="text/javascript" charset="utf-8">
	
	d3up.getBuild({{ $build->id }}).done(function(data) {
		$('.build-gear').buildGear({
			container: $('#build-gear'),
			modify: $('.build-gear-modify'),
			modifyPane: $('#build-gear-modify-pane'),
			modifyToggle: '.icon-signout',
			resultsPane: $("#build-gear-results"),
			resultsTemplate: $("#build-gear-results-template"),
			displayItems: $("#display-items"),
			calc: new d3up.Calc(data)
		});
	});
	
	var sources = [
		'#stats-sidebar'
	];
	
	$.each(sources, function(idx, element) {
		var template = Handlebars.compile($(element).html());
		d3up.getBuild({{ $build->id }}).done(function(data) {
			var calc = new d3up.Calc(data);
			// console.log(calc.stats.gear);
			$(element).replaceWith(template(calc));					
		});
	});
	
	<?= (isset($_GET['debug'])) ? 'd3up.getBuild('.$build->id.').done(function(build) { console.log(d3up.getBuild('.$build->id.'))});' : ''; ?>
</script>