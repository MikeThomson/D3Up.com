<?php

// --------------------------------------------------------------
// Define the directory separator for the environment.
// --------------------------------------------------------------
define('DS', DIRECTORY_SEPARATOR);

// --------------------------------------------------------------
// Set the core Laravel path constants.
// --------------------------------------------------------------
require 'paths.php';

// --------------------------------------------------------------
// Override the application paths when testing the core.
// --------------------------------------------------------------
// $path = path('sys').'tests'.DS;

// set_path('app', $path.'application'.DS);
// 
// set_path('bundle', $path.'bundles'.DS);
// 
// set_path('storage', $path.'storage'.DS);

// --------------------------------------------------------------
// Bootstrap the Laravel core.
// --------------------------------------------------------------
require path('sys').'core.php';

Laravel\Event::listen(Laravel\Config::loader, function($bundle, $file)
{
	return Laravel\Config::file($bundle, $file);
});

// --------------------------------------------------------------
// Start the default bundle.
// --------------------------------------------------------------
Laravel\Bundle::start(DEFAULT_BUNDLE);

// Laravel\Bundle::register('epic_mongo', array('auto' => true));

include(path('app').'../bundles/epic_mongo/Mongo.php');
// Laravel\Bundle::start('myunit');
