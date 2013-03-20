<?php
return array('html regionHelper' => function($id) {
	$regions = array(
		1 => "North America",
		2 => "Europe",
		3 => "Asia",
	);
	return $regions[$id];
});