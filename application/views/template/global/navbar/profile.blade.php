<li class="dropdown pull-right">
  <a href="#" class="dropdown-toggle-clickable" data-toggle="dropdown">							
		<span class='build-name'>{{ ucwords(Auth::user()->username) }}</span>
		<b class="caret"></b>
	</a>
	<div class="dropdown-menu">
		<a href="/logout" class='btn btn-d3up btn-mini btn-block'>{{ __('login.logout') }}</a>
	</div>
</li>