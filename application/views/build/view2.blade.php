@section("headerbar")
<a href="/build">{{ __('d3up.builds') }}</a> 
\ <a href="/build?class={{ $build->class }}">{{ ucwords(str_replace("-", " ", $build->class)) }}</a> 
\ <a href="/b/{{ $build-> id }}">{{ $build->name }}</a> 
@endsection

@section("notifications")
	@include("build.notifications")
@endsection

@section('styles')
<link href="/css/build.css" rel="stylesheet">
<link href="/css/compare.css" rel="stylesheet">
<link href="/css/paperdoll.css" rel="stylesheet">
<link href="/css/utils/chosen.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="/js/build.js"></script>
<script src="/js/utils/build/gear.js"></script>
<script src="/js/utils/chosen.min.js"></script>
<script src="http://api.d3up.com/builds/{{ $build->id }}.js"></script>
@endsection	


@section('content')
<div class='row build-container tab-content'>
	<div class='span12'>
		<ul class="nav nav-pills">
	    <li class="active">
				<a href="#pill-overview" data-toggle="pill">{{ __('build.overview') }}</a>
			</li>
	    <li>
				<a href="#pill-stats" data-toggle="pill">{{ __('build.stats') }}</a>
			</li>
	    <li>
				<a href="#pill-gear" data-toggle="pill">{{ __('build.gear') }}</a>
			</li>
	    <li>
				<a href="#pill-skills" data-toggle="pill">{{ __('build.skills') }}</a>
			</li>
	    <li>
				<a href="#pill-mitigation" data-toggle="pill">{{ __('build.mitigation') }}</a>
			</li>
	  </ul>
		<div class='pill-content'>
			<div class='pill-pane active' id="pill-overview">
				overview
			</div>
			<div class='pill-pane' id="pill-stats">
				stats
			</div>
			<div class='pill-pane' id="pill-gear">
				@include('build.experimental.gear')
			</div>
			<div class='pill-pane' id="pill-mitigation">
				mit
			</div>
			<div class='pill-pane' id="pill-skills">
				skills
			</div>
		</div>
	</div>
</div>
<div id='display-items'> 
	@foreach($build->gear as $slot => $item) 
		<div data-slot="{{ $slot }}">
			@include('item.display')->with('item', $item)
		</div>
	@endforeach
</div>
@endsection