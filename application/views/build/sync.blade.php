<?
	$totals = array();
	foreach($results['messages'] as $res) {
		if(!isset($totals[$res->type])) {
			$totals[$res->type] = 0;
		}
		$totals[$res->type]++;
	}
?>

@section("notifications")
	@include("build.notifications")
@endsection

@section("headerbar")
<a href="/build">{{ __('d3up.builds') }}</a> 
\ <a href="/build?class={{ $build->class }}">{{ ucwords(str_replace("-", " ", $build->class)) }}</a> 
\ <a href="/b/{{ $build-> id }}">{{ $build->name }}</a> 
\ Sync
@endsection

@section('content')
@if((isset($totals['error']) && $totals['error'] > 0) || $results['fatal']) 
<div class='bck alert'>
	@if($results['fatal'])
		<h4><strong class='badge badge-error'>Fatal Error during Battle.net Sync</strong></h4>
		<h4>{{ $results['fatal'] }}</h4>
	@else
		<strong>Possible Warning</strong> 
		We encountered errors while processing your sync request against the Battle.net API.
		<p>If There are many reasons that these requests might fail, here are some common problems:</p>
		<ul>
			<li><strong>Incorrect BattleTag</strong> - Is <strong class='badge badge-warning'>{{ $build->_characterBt }}</strong> actually your BattleTag? If not, edit it in the Build Editor.</li>
			<li><strong>API Unavailable</strong> - To see if the Battle.net API is unavailable, click some of the API requests in the API Log below. If they don't load, Battle.net may be down for maintenance.</li>
			<li><strong>API Failures</strong> - To see if the Battle.net API is having random failures, click one of the API requests in the API Log below and then refresh it around 10 times. If one of the page loads fails, there's an outage someplace on the Armory.</li>
		</ul>
		<p>Many times you'll see these errors if the game and/or battle.net is undergoing patches. However, if this is not the case, feel free to contact me at <a class='badge' href="mailto:aaron.cox@greymass.com">aaron.cox@greymass.com</a> and include the information on this page!</p>
	@endif
</div>
@else
<div class='row'>
	<div class='bck white padding rounded column_10 offset_1 margin-top'>
		<h2>Successfully Imported from Battle.net</h2>
		<p class='margin'>No errors were generated during the import of your character. Feel free to review the information below to see exactly what occurred, or use one of the buttons below to continue on.</p>
		<a href='/api-status' class='button on-right'>Check Battle.net API Status</a>
		<a href='/b/{{ $build->id }}' class='button success'>View Build</a>
		</div>
	</div>
</div>
@endif
@if(!empty($results['messages']))
<div class='row margin-top'>
	<div class='column_9 padding bck white rounded'>
		<h4 class='text large margin-bottom'>Items Detected and Equipped</h4>
		<div class='items-horizontal padding-5 bck dark clearfix rounded'>
		@foreach($build->getGear() as $slot => $item)
			<span class='item'>
				<a href="/i/{{ $item->id }}" data-json="{{ e(json_encode($item->json())) }}" data-slot="{{ $slot }}">
					{{ HTML::itemIcon($item) }}
				</a>
			</span>
		@endforeach
		</div>
		<h4 class='text large margin-bottom margin-top'>Skills and Passives Detected</h4>
		<div class="padding-5 bck dark clearfix rounded">
			<ul class='skills skill-icons skills-horizontal'>
				@foreach($build->actives as $skill)
				<li class='skill-icon icon-frame'>
					<img src='/img/icons/{{ $build->class }}-{{ explode("~", $skill)[0] }}.png'>
				</li>
				@endforeach
				@foreach($build->passives as $skill)
				<li class='skill-icon icon-frame'>
					<img src='/img/icons/{{ $build->class }}-{{ explode("~", $skill)[0] }}.png'>
				</li>		
				@endforeach
			</ul>
		</div>
	</div>
	<div class='column_3 padding bck white rounded'>
		<h4 class='text large margin-bottom'>Testing Calculator</h4>
		<p>Unbuffed DPS: {{ HTML::hb('prettyStat stats.dps.dps') }}</p>
		<p>Unbuffed EHP: {{ HTML::hb('prettyStat stats.ehp.ehp') }}</p>
	</div>
</div>
<div class='row'>
	<div class='column_12'>
		<h4 class='text small margin-top'>Battle.net Sync/API Results</h4>
		<table>
			<tr>
				<td class='text center' colspan="2">
					@foreach($totals as $type => $total)
						<span class='tag bck dark'>{{ $total }} {{ $type }} messages</span>
					@endforeach
				</td>
			</tr>
		@foreach($results['messages'] as $res) 
			<tr>
				<td class='text right'>
					<span class='tag bck theme'>{{ $res->type }}</span>
				</td>
				<td>{{ $res->message }}</td>
			</tr>
		@endforeach
		</table>
	</div>
@endif

<div id='character' data-json='{{ json_encode($build->json()) }}'></div>
<script>
	
	var sources = [
		'#sync-stats'
	];
	
	$.each(sources, function(idx, element) {
		var template = Handlebars.compile($(element).html());
		d3up.getBuild({{ $build->id }}).done(function(data) {
			var calc = new d3up.Calc(data);
			$(element).replaceWith(template(calc));					
			$.ajax({
				url: '/b/' + {{ $build->id }} + '/cache',
				cache: false,
				data: {
@if($build->_syncKey)
					syncKey: '{{ $build->_syncKey }}',
@endif
					stats: calc.stats
				},
				type: 'post',
				dataType: 'json'
			});
			
		});
	});
	
</script>
@endsection

