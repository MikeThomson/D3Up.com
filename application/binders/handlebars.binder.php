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
return array('html hb' => function($text) {
	return "{{".$text."}}";
});