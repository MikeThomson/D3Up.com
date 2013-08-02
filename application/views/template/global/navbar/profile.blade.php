<li class="dropdown pull-right">
  <a href="#" class="dropdown-toggle-clickable" data-toggle="dropdown">							
		<span class='build-name'>{{ ucwords(Auth::user()->username) }}</span>
		<b class="caret"></b>
	</a>
	<div class="dropdown-menu">
		<a href="/user" class='btn btn-d3up btn-mini btn-block'>{{ __('login.profile') }}</a>
		<a href="/user/builds" class='btn btn-d3up btn-mini btn-block'>{{ __('login.builds') }}</a>
		<a href="/user/items" class='btn btn-d3up btn-mini btn-block'>{{ __('login.items') }}</a>
		<a href="/password" class='btn btn-d3up btn-mini btn-block'>{{ __('login.change_password') }}</a>
		<a href="/logout" class='btn btn-d3up btn-mini btn-block'>{{ __('login.logout') }}</a>
	</div>
</li>