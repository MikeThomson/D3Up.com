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
<script src="http://phalcon.d3up.com/builds/{{ $build->id }}.js"></script>
@endsection	


@section('content')
<div class='row'>
	<div class='column_12'>
		<nav data-tuktuk="menu" data-role="tabs" class="margin-top margin-bottom center text small bold clearfix">
			<a href data-tab="#tab-overview" data-toggle="tab">{{ __('build.overview') }}</a>
			<a href data-tab="#tab-stats" data-toggle="tab">{{ __('build.stats') }}</a>
			<a href data-tab="#tab-gear" data-toggle="tab">{{ __('build.gear') }}</a>
			<a href data-tab="#tab-skills" data-toggle="tab">{{ __('build.skills') }}</a>
			<a href data-tab="#tab-mitigation" data-toggle="tab">{{ __('build.mitigation') }}</a>
		</nav>
	</div>
</div>
<div id="tab-overview" data-role="tab">
	@include('build.experimental.overview')
</div>
<div id="tab-stats" data-role="tab">
	stats
</div>
<div id="tab-gear" data-role="tab">
	@include('build.experimental.gear')
</div>
<div id="tab-mitigation" data-role="tab">
	mit
</div>
<div id="tab-skills" data-role="tab">
	skills
</div>
@include("template.global.scripts.tabs")
@endsection
