@layout('template.main')

@section('content')
	<table class='table' id="browser">
		<thead></thead>
		<tbody></tbody>
		<tfoot></tfoot>
	</table>
	<script type="text/javascript" charset="utf-8">
		$("#browser").buildBrowser({
			filters: $("#browser").find("thead"),
			container: $("#browser").find("tbody")
		});
	</script>
@endsection