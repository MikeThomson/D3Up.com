@layout('template.main')
<?
	$totals = array();
	foreach($results as $res) {
		if(!isset($totals[$res->type])) {
			$totals[$res->type] = 0;
		}
		$totals[$res->type]++;
	}
?>
@section('content')
<div class="content-page sync-results">		
	@if(isset($totals['error']) && $totals['error'] > 0) 
	<div  class='alert alert-error'>
	<p><strong>ERRORS!</strong> We encountered errors while processing your sync request against the Battle.net API.</p>
	<p>There are many reasons that these requests might fail, here are some common problems:</p>
	<ul>
		<li><strong>Incorrect BattleTag</strong> - Is <strong class='badge badge-warning'>{{ $build->_characterBt }}</strong> actually your BattleTag? If not, edit it in the Build Editor.</li>
		<li><strong>API Unavailable</strong> - To see if the Battle.net API is unavailable, click some of the API requests in the API Log below. If they don't load, Battle.net may be down for maintenance.</li>
		<li><strong>API Failures</strong> - To see if the Battle.net API is having random failures, click one of the API requests in the API Log below and then refresh it around 10 times. If one of the page loads fails, there's an outage someplace on the Armory.</li>
	</ul>
	<p>Many times you'll see these errors if the game and/or battle.net is undergoing patches. However, if this is not the case, feel free to contact me at <a class='badge' href="mailto:aaron.cox@greymass.com">aaron.cox@greymass.com</a> and include the information on this page!</p>
	</div>
	@else
	<p class='alert alert-success'>No errors were generated during this process, you will be redirected to your build in 5 seconds. If you are not redirected automatically, <a href="/b/{{ $build->id }}" class='badge badge-success'>click here to proceed</a>.</p>
	@endif
	<h4>Results/API Log</h4>
	<p>
	@foreach($totals as $type => $total)
		<span class='badge badge-{{ $type }}'>{{ $total }} {{ $type }} messages</span>
	@endforeach
	</p>
	<ul class="sync">
	@foreach($results as $res) 
		<li class='alert-{{ $res->type }}'>{{ $res->message }}</li>
	@endforeach
	</ul>
</div>
@endsection