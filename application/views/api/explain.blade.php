@layout('template.main')

@section('content')
	<style type="text/css" media="screen">
	.table a,
		.table {
			color: #000;
		}
	</style>
	<h2>D3Up.com API Query Explanation</h2>
	<p>Exactly what this API call is doing and the meta information about it.</p>
	<h3>Info</h3>
	<pre>{{ print_r($info) }}</pre>
	<h3>Explain</h3>
	<pre>{{ print_r($explain) }}</pre>
@endsection