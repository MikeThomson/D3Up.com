@layout('template.main')

@section('scripts')
<script src="http://d3up.com/js/gamedata.js"></script>
@endsection

@section('styles')
<link href="/css/utils/chosen.css" rel="stylesheet">
@endsection

@section('headerbar')
	Browse Diablo 3 Builds by Class
@endsection

@section('notifications')
	<span class='label label-error' data-placement="left" data-toggle="popover" data-title="D3Up doens't rank Builds" data-content="D3Up doesn't contain every character on Battle.net, only those created by you. Therefore, we do not rank builds, but you can still sort by EHP/DPS.">No Rankings</span>
	<span class='label label-info' data-placement="left" data-toggle="popover" data-title="DPS/EHP Missing from Builds" data-content="Whenever you resync your build, the EHP and DPS numbers are calculated and saved to the database. If they do not show up here, simply resync.">Blank DPS/EHP</span>
@endsection

@section('content')
	<table class='table table-bordered table-condensed table-builds' id="browser">
		<thead></thead>
		<tbody></tbody>
		<tfoot></tfoot>
	</table>
	<script type="text/javascript" charset="utf-8">
		$("#browser").buildBrowser({
			filters: $("#browser").find("thead"),
			paginators: $("#browser").find("thead, tfoot"),
			container: $("#browser").find("tbody"),
			footer: $("#browser").find("tfoot"),
			columns: ['icon', 'name', 'region_type', 'level', 'paragon', 'actives', 'passives', 'dps', 'ehp']
		});
	</script>
@endsection