<li class="dropdown pull-right">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">							
		{{ ucwords(Auth::user()->username) }}
		<b class="caret"></b>
	</a>
	<div class="dropdown-menu">
		<a href="/logout" class='btn btn-mini btn-block'>Logout</a>
	</div>
</li>
