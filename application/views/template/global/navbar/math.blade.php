<?php
	$query = array();
	$sort = array(
		'_created' => -1,
	);
	$recent = Epic_Mongo::db('math')->find($query)->sort($sort)->limit(5);
?>
<ul class="dropdown-menu">
	@foreach($recent as $math)
  <li><a href="/math/{{ $math->id }}">{{ $math->title }}</a></li>
	@endforeach
	<li><a href="/math" class='btn btn-block'>Diablo 3 Math Explained</a></li>
</ul>
