<?php
/*
|--------------------------------------------------------------------------
| hb - Handlebars Helper
|--------------------------------------------------------------------------
|
| Since HandleBars and Blade use the same syntax of: {{ expression }}, I 
| wrote a helper for when you need to embed a handlebars expression.
| 
| Usage: HTML::hb("stats.dps")
| Output: {{ stats.dps }}
| 
*/
return array('html getGemId' => function($string) {
	if(isset(D3Up_Gems::$gemIds[$string])) {
		return D3Up_Gems::$gemIds[$string];
	}
	return null;
	// array_search($string, D3Up_Gems::$gemIds)
	// var_dump($string); exit;
	return $string;
});