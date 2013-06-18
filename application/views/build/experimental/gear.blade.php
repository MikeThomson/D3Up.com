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
	.build-gear .active-modify{
		background-color: #000;
	}	
	.build-gear-modify {
		padding: 15px;
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
	.build-gear .table-gear .icon-signout {
		color: #333; 
		border-color: #333;
		line-height: 28px;
	}
	.build-gear .table-gear .icon-signout:hover {
		color: #ececec; 
		border-color: #ececec;
	}
</style>

<div class="row">
	<div class="span9">
		<div class="build-gear">
			<div class='build-gear-modify'>
				@include('build.experimental.gear.modify')
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
								{{ HTML::itemLink($item, array('slot' => $slot)) }}
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
			gearList: '.table-gear',
			modify: $('.build-gear-modify'),
			modifyPane: $('#build-gear-modify-pane'),
			modifyToggle: '.icon-signout',
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