<?php
/*
|--------------------------------------------------------------------------
| tooltipColor - Tooltip Color Helper
|--------------------------------------------------------------------------
|
| Converts INT versions of build 'quality' to the colors of items
|
| Usage: HTML::tooltipColor(number)
| Output: "green"
|
*/
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