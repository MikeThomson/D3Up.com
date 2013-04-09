<?php
/*
|--------------------------------------------------------------------------
| regionHelper - Converts INT versions of Regions to English
|--------------------------------------------------------------------------
|
| Builds store regions as an integer, this converts them to English
|
|		!!!! Note - This needs to be made to work with Localization eventually
| 
| Usage: HTML::regionHelper(number)
| Output: "North America"
|
*/
return array('html regionHelper' => function($id) {
	// The list of regions
	$regions = array(
		1 => "North America",
		2 => "Europe",
		3 => "Asia",
	);
	// Return it
	return $regions[$id];
});