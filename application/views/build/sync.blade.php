<?
	$totals = array();
	foreach($results['messages'] as $res) {
		if(!isset($totals[$res->type])) {
			$totals[$res->type] = 0;
		}
		$totals[$res->type]++;
	}
?>

@section('styles')
<link href="/css/build.css" rel="stylesheet">
<link href="/css/compare.css" rel="stylesheet">
@endsection

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
<div class='alert alert-error'>
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
<div class='alert alert-success'>
	<h2>Successfully Imported from Battle.net</h2>
	<p>No errors were generated during the import of your character. Feel free to review the information below to see exactly what occurred, or use one of the buttons below to continue on.</p>
	<div class='btn-group'>
		<a href='/b/{{ $build->id }}' class='btn btn-primary'>View Build</a>
		<a href='/api-status' class='btn'>Check Battle.net API Status</a>
	</div>
</div>
@endif
@if(!empty($results['messages']))
	<div class="content-page sync-results">
		<h4>Testing Calculated Values</h4>
		<div id="sync-stats">
			<span class="label label-important">Absolute Unbuffed DPS: {{ HTML::hb('prettyStat stats.dps.dps') }}</span>
			<span class="label label-success">Absolute Unbuffed EHP: {{ HTML::hb('prettyStat stats.ehp.ehp') }}</span>
		</div>
		<h4>Items Detected and Equipped</h4>
		<div class='items-horizontal'>
		@foreach($build->getGear() as $slot => $item)
			<span class='item'>
				<a href="/i/{{ $item->id }}" data-json="{{ e(json_encode($item->json())) }}" data-slot="{{ $slot }}">
					{{ HTML::itemIcon($item) }}
				</a>
			</span>
		@endforeach
		</div>
		<h4>Skills and Passives Detected</h4>
		<ul class='skills skills-horizontal'>
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
		<h4>Battle.net Sync/API Results</h4>
		<p>
		@foreach($totals as $type => $total)
			<span class='badge badge-{{ $type }}'>{{ $total }} {{ $type }} messages</span>
		@endforeach
		</p>
		<ul class="sync">
		@foreach($results['messages'] as $res) 
			<li class='alert-{{ $res->type }}'>{{ $res->message }}</li>
		@endforeach
		</ul>
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

