@section('styles')
<link href="/css/build.css" rel="stylesheet">
<link href="/css/compare.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="/js/build.js"></script>
<script src="/js/utils/compare.js"></script>
<script src="http://api.d3up.com/builds/1.js"></script>
@endsection
<style type="text/css" media="screen">
	.build .navbar-inner {
		padding: 0;
		min-height: auto;
	}
	.build .nav-pills li a {
		margin: 0;
		padding: 10px 20px;
	}
	.build .nav-pills li a:hover {
		background-color: #000;
	}
</style>
<div>
	<div class='navbar build'>
		<div class='navbar-inner'>
			<ul class="nav nav-pills">
		    <li class="active">
					<a href="#tab-overview" data-toggle="tab">{{ __('build.overview') }}</a>
				</li>
		    <li>
					<a href="#tab-stats" data-toggle="tab">{{ __('build.stats') }}</a>
				</li>
		    <li>
					<a href="#tab-gear" data-toggle="tab">{{ __('build.gear') }}</a>
				</li>
		    <li>
					<a href="#tab-skills" data-toggle="tab">{{ __('build.skills') }}</a>
				</li>
		    <li>
					<a href="#tab-mitigation" data-toggle="tab">{{ __('build.mitigation') }}</a>
				</li>
		  </ul>
		</div>
	</div>
	<div class='tab-pane active' id="tab-overview">
		<div class='span5 build1-stats'>
			overview
		</div>
		<div class='span2'>
			overview
		</div>
		<div class='span5 build2-stats'>
			overview
		</div>
	</div>
	<div class='tab-pane' id="tab-stats">
		<div class='span5 build1-stats'>
			stats
		</div>
		<div class='span2'>
			stats
		</div>
		<div class='span5 build2-stats'>
			stats
		</div>
	</div>
</div>