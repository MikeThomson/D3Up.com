<?php
return array('html tooltipColor' => function($color) {
	$colors = array(
		1 => "white",
		2 => "",
		3 => "Asia",
		4 => "blue",
		5 => "yellow",
		6 => "orange",
		7 => "green",
	);
	return $colors[$color];
});