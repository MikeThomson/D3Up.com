<li class="dropdown">
  <a href="#" class="brand brand-extend dropdown-toggle" data-toggle="dropdown">							
		<span class='badge badge-inverse'>
			{{ Auth::user()->username }}
			<b class="caret"></b>
		</span>
	</a>
	<div class="dropdown-menu">
		<a href="/logout" class='btn btn-mini btn-block'>Logout</a>
	</div>
</li>
