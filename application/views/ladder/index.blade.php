@section('styles')
<link href="/css/build.css" rel="stylesheet">
<link href="/css/compare.css" rel="stylesheet">
@endsection

@section('headerbar')
<a href="http://reddit.com/r/diablo">/r/diablo ladder system</a>
@endsection

@section('content')
	<div class="title-block">
		<div class="title-inner">
			<div class='row-fluid'>
				<div class='span10 offset1'>
					<a class='btn pull-right btn-success' href='/ladder/join'>Join the Ladder</a>
					<h2>Ladder Test</h2>
					<p>Simple test of the engine to see how easy a ladder would be.</p>
				</div>
			</div>
		</div>
	</div>
	@include('build.table', array('builds' => $ladder->builds))
@endsection