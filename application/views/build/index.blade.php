@section('styles')
<link href="/css/utils/chosen.css" rel="stylesheet">
@endsection

@section('notifications')
	<span class='label label-error' data-placement="left" data-toggle="popover" data-title="D3Up Does NOT Rank Builds" data-content="D3Up doesn't contain every character on Battle.net, only those created by you. Therefore, we do not do global ranking of characters. D3Up does still offers the ability to sort by EHP/DPS.">No Rankings</span>
	<span class='label label-info' data-placement="left" data-toggle="popover" data-title="DPS/EHP Missing from Builds" data-content="Whenever you resync your build, the EHP and DPS numbers are calculated and saved to the database. If they do not show up here, simply resync.">Blank DPS/EHP</span>
@endsection

@section('content')
@include('template.search')

<div class='row'>
	<div class='column_12'>
		<table class='table table-bordered table-condensed table-builds no-margin' id="browser">
			<thead></thead>
			<tbody></tbody>
			<tfoot></tfoot>
		</table>
	</div>
</div>
<script type="text/javascript" charset="utf-8">
	$("#browser").buildBrowser({
		filters: $("#browser").find("thead"),
		paginators: $("#browser").find("thead, tfoot"),
		container: $("#browser").find("tbody"),
		footer: $("#browser").find("tfoot"),
		search: $("input#battletag"),
		columns: ['icon', 'name', 'region_type', 'level', 'paragon', 'actives', 'passives', 'dps', 'ehp']
	});
</script>
@endsection