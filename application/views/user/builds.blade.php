@section('styles')
<link href="/css/utils/chosen.css" rel="stylesheet">
@endsection

@section('headerbar')
	My Builds
@endsection

@section('notifications')

@endsection

@section('content')
	<table class='table table-bordered table-condensed table-builds' id="browser">
		<thead></thead>
		<tbody></tbody>
		<tfoot></tfoot>
	</table>
	<script type="text/javascript" charset="utf-8">
		$("#browser").buildBrowser({
			user_id: {{ Auth::user()->id }},
			filters: $("#browser").find("thead"),
			paginators: $("#browser").find("thead, tfoot"),
			container: $("#browser").find("tbody"),
			footer: $("#browser").find("tfoot"),
			columns: ['icon', 'name', 'region_type', 'level', 'paragon', 'actives', 'passives', 'dps', 'ehp']
		});
	</script>
@endsection