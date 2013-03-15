<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="/">
				<img src='/img/logo_small.jpg'>
			</a>
			<div class='nav-collapse'>
				<ul class="nav">
					<li <?= (isset($build) || Auth::check()) ? 'class="dropdown"' : ''?>>
						@if(isset($build))
					  <a href="#" class="build-select <?= (Auth::check()) ? 'dropdown-toggle' : '' ?>" data-toggle="dropdown">							
							<img src="/img/icons/{{ $build->class }}.png" class="build-icon pull-left">
							<div class='build-name'>{{ $build->name }}</div>
							<small>
								<span class="level">{{ __('build.level') }} {{ $build->level }}</span>, {{ __('build.paragon') }} <span class="paragon">{{ $build->paragon }}</span>
							</small>
							<?= (Auth::check()) ? '<b class="caret"></b>' : '' ?>
						</a>
						@else
							@if(Auth::check())
								<a href="#" class="build-select <?= (Auth::check()) ? 'dropdown-toggle' : '' ?>" data-toggle="dropdown">							
									<img src="/img/icons/unknown.png" class="build-icon pull-left" style="width: 36px">
									<div class='build-name'>{{ __('d3up.build_quick_select') }}</div>
									<small>{{ __('d3up.my_highest_level_builds') }}</small>
									<?= (Auth::check()) ? '<b class="caret"></b>' : '' ?>
								</a>
							@endif
						@endif
						@if(Auth::check())
							@include("template.global.navbar.user")
						@else
							@include("template.global.navbar.anonymous")
						@endif
					</li>
	        <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ __('d3up.builds') }} <b class="caret"></b></a>
						<div class="dropdown-menu">
	            <ul>
								<li class='barbarian'><a href="/build?class=barbarian">{{ __('build.barbarian') }}</a></li>
								<li class='demon-hunter'><a href="/build?class=demon-hunter">{{ __('build.demon-hunter') }}</a></li>
								<li class='monk'><a href="/build?class=monk">{{ __('build.monk') }}</a></li>
								<li class='witch-doctor'><a href="/build?class=witch-doctor">{{ __('build.witch-doctor') }}</a></li>
								<li class='wizard'><a href="/build?class=wizard">{{ __('build.wizard') }}</a></li>
	            </ul>
						</div>
					</li>
	        <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ __('d3up.guides') }} <b class="caret"></b></a>
	         	<ul class="dropdown-menu">
	           	<li><a href="#">Build #1</a></li>
	           	<li><a href="#">Build #2</a></li>
	           	<li><a href="#">Build #3</a></li>
	           	<li><a href="#">Build #4</a></li>
	           	<li><a href="#">Build #5</a></li>
	         	</ul>
					</li>
	        <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ __('d3up.math') }} <b class="caret"></b></a>
						@include("template.global.navbar.math")
	        </li>
				</ul>
				<ul class='nav pull-right'>
					@if(Auth::check())
						@include("template.global.navbar.profile")
					@else
					<li class='dropdown'>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="/img/locale/{{ Session::get('locale') }}.png"> {{ Session::get('locale_name') }}
						</a>
						<ul class="dropdown-menu">
						@foreach(Config::get('application.languages') as $lang => $name)
							<li>
								<a href="/locale/{{ $lang }}">
									<img src="/img/locale/{{ $lang }}.png"> {{ $name }}
								</a>
							</li>
						@endforeach
						</ul>
					</li>
					@endif
					<li>
						<form class="navbar-search pull-right" action="/search">
		          <input type="text" class="search-query span3" placeholder="{{ __('d3up.search_by_battletag') }}">
		        </form>
					</li>
				</ul>
			</div><!-- /.nav-collapse -->
    </div><!-- /.container -->
  </div><!-- /.navbar-inner -->
</div><!-- /.navbar -->
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('.dropdown-toggle').dropdown();
		$('.navbar .dropdown-menu').click(function(e) {
		    e.stopPropagation();
		});
	});
	
</script>