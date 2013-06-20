<?php
/*
|--------------------------------------------------------------------------
| script - Returns either a minified version of the scripts or all scripts
|--------------------------------------------------------------------------
*/
return array('html scripts' => function() {
	if(Input::get('debug') || Request::env() == 'development') {
		// If we are in development mode
		$scripts = "";
		// Loop through the files that are minified
		foreach(Config::get('scripts.files') as $file) {
			// Append the Path for the File
			$path = '/js/'.$file;
			// Add the Script tag for this file
			$scripts .= HTML::script($path);
		}
		// Return individual unminified versions into the head
		return $scripts;
	} else {
		// Return the minified version from S3
		return HTML::script(Config::get('scripts.s3'));
	}
});