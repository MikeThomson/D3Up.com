<style type="text/css" media="screen">
	.build-gear {
		position: relative;
		padding: 10px;
		border: 1px solid #333;
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		background-color: #111;
	}
	.build-gear .active-modify {
		background-color: #000;
	}	
	.build-gear-modify {
		padding: 5px;
		display: none;
		background-color: #000;
		border-left: 1px solid #333;
		position: absolute;
		top: 0;
		right: 0;
		width: 360px;
	}
	.build-gear .table-gear {
		background-color: #1b1b1b;
		margin-bottom: 0;
	}
	.build-gear .table-gear .item-icon img {
		vertical-align: top;
	}
	.build-gear .table-gear thead th {
		color: #70B1D5;
		border: 1px solid #333;
		font-size: 0.75em;
		line-height: 0.85em;
		background-color: #2b2b2b;
		text-align: right;
	}
	.build-gear .table-gear tbody td {
		border: 1px solid #333;
		line-height: 34px;
		text-align: right;
	}
	.build-gear .table-gear thead th:first-child,
	.build-gear .table-gear tbody td:first-child {
		text-align: left;
	}
	.build-gear .icon-signout {
		color: #333; 
		background-color: #111;
		border-color: #333;
		line-height: 28px;
	}
	.build-gear tr.item:hover .icon-signout {
		cursor: pointer;
		color: #ececec; 
		border-color: #ececec;
	}
	.build-gear tr.item.active-modify:hover .icon-signout,
	.build-gear .active-modify .icon-signout {
		color: #70B1D5; 
		border-color: #70B1D5;		
	}
</style>

<div class="row">
	<div class="span9">
		<div class="build-gear">
			<div class='build-gear-modify'>
			</div>
			<script id="build-gear{{ ((isset($id)) ? ('-'.$id) : "") }}" type="text/x-handlebars-template">
				<table class='table table-gear'>
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
	<div class="span3">
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