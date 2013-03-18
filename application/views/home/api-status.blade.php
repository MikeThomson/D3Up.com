@layout('template.main')

@section('content')
	<h2>Battle.net API Status</h2>
	<p>D3Up uses the Battle.net API to retrieve your characters, items and skills. When the API is down (for Patching/Maintenence), it prevents D3Up from reading and updating your characters builds. This page is used to check on the status of the Battle.net API, to let you know if Battle.net is the reason your characters aren't syncing properly.</p>
	<div class="alert {{ ($status[1]) ? 'alert-success' : 'alert-error' }}">
		<strong>North America</strong>: {{ ($status[1]) ? "Online" : "Unable to Connect" }}
	</div>
	<div class="alert {{ ($status[2]) ? 'alert-success' : 'alert-error' }}">
		<strong>Europe</strong>: {{ ($status[2]) ? "Online" : "Unable to Connect" }}
	</div>
	<div class="alert {{ ($status[3]) ? 'alert-success' : 'alert-error' }}">
		<strong>Asia</strong>: {{ ($status[3]) ? "Online" : "Unable to Connect" }}
	</div>
	<p>The API Status page here on D3Up.com refreshes every 5 minutes.</p>
	<h3>Last API Status Check performed: {{ date("Y-m-d H:i:s", Cache::get('api-status-checked')) }}</h3>
@endsection