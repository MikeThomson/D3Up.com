<?php
/*
|--------------------------------------------------------------------------
| prettyStat - Makes numbers Pretty!
|--------------------------------------------------------------------------
|
| This helper will reduce 65,000 to 65k, 1,000,000 to 1m and so on.
| 
| Usage: HTML::prettyStat(number, roundTo)
| Parameters: 
|				- number: a float or int, the number to format
|				- roundTo: the number of decimal places to return
| Output: 
|
*/
return array('html prettyStat' => function($value, $roundTo = 2) {
	// If we get an invalid number, return "~" as a placeholder
	if(!$value || !is_numeric($value)) {
		return '~';
	} 
	// Convert the Value into a float
	$val = (float) $value;
	// Cycle through supported values
	if($val >= 1000000000000) {
		return round($val / 1000000000000, $roundTo) ."t";
	}
	if($val >= 1000000000) {
		return round($val / 1000000000, $roundTo) ."b";
	}
	if($val >= 1000000) {
		return round($val / 1000000, $roundTo) ."m";
	}
	if($val >= 1000) {
		return round($val / 1000, $roundTo) ."k";
	}
	return round($val, $roundTo);
});