<ul class='breadcrumb'>
	<li><a href='/math'>Math</a></li>
	@if(isset($math) && isset($lang))
		<li><span class="divider">/</span></li>
		<li><a href='/math/{{ $math->id }}'>{{ $math->_localized[$lang]['title'] }}</a></li>
	@endif
	@if(Auth::user() && !isset($noNav))
	<li class='btn-group pull-right'>
		<a href='/math/1/history?language={{$lang}}' class='btn btn-mini'>History</a>
		@if(isset($math) && isset($lang))
		<a href='/math/1/edit?language={{$lang}}' class='btn btn-mini'>Edit</a>
		<a href='/math/1/edit' class='btn btn-mini'>Translate</a>
		@endif
		<a href='/math/create' class='btn btn-mini'>Create New</a>
	</li>
	@endif
</ul>