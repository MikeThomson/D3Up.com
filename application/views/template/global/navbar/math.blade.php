<?php
	$query = array();
	$sort = array(
		'_created' => -1,
	);
	$recent = Epic_Mongo::db('math')->find($query)->sort($sort)->limit(5);
	$lang = Config::get('application.language');
	$langs = Config::get('application.languages');
?>
<div class="dropdown-menu dropdown-classes">
	<h3>Browse Diablo 3 Math</h3>
	<ul>
		@foreach($recent as $math)
	  <li>
			<a href="/math/{{ $math->id }}">
				@if(isset($math->_localized[$lang]))
					{{ $math->_localized[$lang]['title'] }}
				@else 
					{{ $math->title }} 
					@foreach($math->_localized as $lang => $data)
					({{ strtoupper($lang) }})
					@endforeach
				@endif
			</a>
		</li>
		@endforeach
		<li class='controls'><a href="/math" class='btn btn-block'>Diablo 3 Math Explained</a></li>
	</ul>
</div>