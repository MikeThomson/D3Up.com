@layout('template.main')

@section('content')
	<h2>Battle.net API Status</h2>
	<p>D3Up uses the Battle.net API to retrieve your characters, items and skills. When the API is down (for Patching/Maintenence), it prevents D3Up from reading and updating your characters builds. This page is used to check on the status of the Battle.net API, to let you know if Battle.net is the reason your characters aren't syncing properly.</p>
	@foreach($status as $region => $data)
	<div class="alert {{ ($status[$region]) ? 'alert-success' : 'alert-error' }}">
		<strong>{{ __('locale.'.$region) }}</strong>: {{ ($status[$region]) ? "Online" : "Unable to Connect" }}
		(Tested against: <a href='http://{{ $region }}.battle.net/api/d3/data/follower/scoundrel'>Scoundrel Data</a>)
	</div>
	@endforeach
	<p>The API Status page here on D3Up.com refreshes every 5 minutes.</p>
	<h3>Last API Status Check performed: {{ date("Y-m-d H:i:s", Cache::get('api-status-checked')) }}</h3>
@endsection