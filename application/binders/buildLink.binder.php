<?php
/*
|--------------------------------------------------------------------------
| buildLink - Automatic Build Links
|--------------------------------------------------------------------------
|
| A helper to automatically create a link to a build from within blade templates.
| 
| Usage: HTML::buildLink($build)
| Output: <a href='/b/#'>Build Name</a>
|
*/
return array('html buildLink' => function($build, $params = array()) {
	// If we don't have a build, just return null
	if(!$build || !$build instanceOf D3Up_Build) {
		return null;
	}
	// Default Link
	$link = '/b/'.$build->id;
	// Extra Parameters (TODO - Will put JSON info here for Tooltips)
	$options = array();
	// Conditional Options
	return HTML::link(
		$link,
		$build->name, 
		$options
	);
});