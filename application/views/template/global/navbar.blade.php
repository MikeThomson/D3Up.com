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
					@if(Auth::check())
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle-clickable iconmenu-dropdown" data-toggle="dropdown">							
							<span class='icon-frame icon-custom icon-custom-followers profile-icon'></span>
						</a>
						@include("template.global.navbar.user")
					</li>
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle-clickable iconmenu-dropdown" data-toggle="dropdown">							
							<span class='icon-frame icon-custom icon-custom-gear profile-icon'></span>							
						</a>
						<!-- <div class="dropdown-menu">
							<ul>
								<li>Hrm, what could this be? =)</li>
							</ul>
						</div> -->
					</li>
					@else
						@include("template.global.navbar.anonymous")
					@endif
	        <li class="dropdown">
						<a href="/build" class="dropdown-toggle-clickable">{{ __('d3up.builds') }} <b class="caret"></b></a>
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
						<a href="/guide" class="dropdown-toggle-clickable">{{ __('d3up.guides') }} <b class="caret"></b></a>
						<div class="dropdown-menu">
	            <ul>
								<li class='barbarian'><a href="/guide?class=barbarian">{{ __('build.barbarian') }}</a></li>
								<li class='demon-hunter'><a href="/guide?class=demon-hunter">{{ __('build.demon-hunter') }}</a></li>
								<li class='monk'><a href="/guide?class=monk">{{ __('build.monk') }}</a></li>
								<li class='witch-doctor'><a href="/guide?class=witch-doctor">{{ __('build.witch-doctor') }}</a></li>
								<li class='wizard'><a href="/guide?class=wizard">{{ __('build.wizard') }}</a></li>
	         		</ul>
						</div>
					</li>
	        <li class="dropdown">
						<a href="/math" class="dropdown-toggle-clickable">{{ __('d3up.math') }} <b class="caret"></b></a>
						@include("template.global.navbar.math")
	        </li>
				</ul>
				<ul class='nav pull-right'>
					@if(Auth::check())
						@include("template.global.navbar.profile")
					@else
					<li class='dropdown'>
						<a href="#" class="dropdown-toggle-clickable" data-toggle="dropdown">
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
		          <input type="text" class="search-query span3" name="battletag" placeholder="{{ __('d3up.search_by_battletag') }}" value="{{ Request::get('battletag') }}">
		        </form>
					</li>
				</ul>
			</div><!-- /.nav-collapse -->
    </div><!-- /.container -->
  </div><!-- /.navbar-inner -->
</div><!-- /.navbar -->