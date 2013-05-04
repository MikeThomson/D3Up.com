@layout('template.main')

@section('scripts')
<script src="http://d3up.com/js/gamedata.js"></script>
@endsection

@section('styles')
<link href="/css/utils/chosen.css" rel="stylesheet">
@endsection

<style type="text/css" media="screen">
	#browser .btn-toolbar {
		margin: 0;
	}
	#browser .filters select {
		display: inline-block;
		vertical-align: middle;
		margin-bottom: 0;
		margin-right: 10px;
	}
	#browser .multiselect-container.dropdown-menu .input-prepend {
		width: auto;
		display: block;
	}
	#browser .multiselect-search {
		height: auto;
		width: 90%;
	}
	#browser .input-append .active, 
	#browser .input-prepend .active {
		background-color: #70B1D5;
	}
	#browser .input-append .active a:hover, 
	#browser .input-prepend .active a:hover {
		color: #000;
	}
	#browser .input-append .btn-danger {
		margin-left: 0;
	}
</style>

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