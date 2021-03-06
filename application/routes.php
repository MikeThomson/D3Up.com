<?php

/*
|--------------------------------------------------------------------------
| D3Up.com Specific Routing
|--------------------------------------------------------------------------
*/

// Route to Edit an Item
Route::get('/i/(:num)/edit', 'item@edit');
// Route to Sync a Build
Route::get('/b/(:num)/sync', 'build@sync');
// Route to Cache a Build's Stats
Route::post('/b/(:num)/cache', 'build@cache');
// Route to Display a build's signature information
Route::get('/b/(:num)/signature', 'build@signature');
// Route to regenerate a build's signature to s3
Route::post('/b/(:num)/signature', 'build@signature');
// Route to Compare two builds
Route::get('/c/(:num)/(:num)', 'build@compare');
// Route to View an Item
Route::get('/i/(:num)/(:any?)', 'item@view');
// Route to Post to an Item
Route::post('/i/(:num)/(:any?)', 'item@edit');
// Route to View a build
Route::get('/b/(:num)/(:any?)', 'build@view');
// Route to Post an Edit to a build
Route::post('/b/(:num)/(:any?)', 'build@view');
// Math History Routing
Route::get('math/(:num)/history', 'math@history');
// Math Edit Routing
Route::get('math/(:num)/edit', 'math@edit');
// Math Edit Routing (Dialog)
Route::get('math/(:num)/delete', 'math@delete');
// Math Edit Routing (Confirmation)
Route::post('math/(:num)/delete', 'math@delete');
// Math Routing
Route::get('math/(:num)/(:any?)', 'math@view');
// FAQ Routing
Route::get('/faq/(:any?)', 'home@faq');
// Guide Routing
Route::get('guide/(:num)/(:any?)', 'guide@view');
// API Status Checker
Route::get('api-status', 'home@apistatus');
// AJAX Build Modifier
Route::get('/a/(:num)/(:any?)', 'build@ajax');


// Test Build Loader
Route::get('/l/(:num)/(:any?)', 'build@loader');

// Detect Controllers and Build Routes for them
Route::controller(Controller::detect());

// Locale Swapping Route
Route::get('locale/(:any)', 'base@locale');


/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
	
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});

/*
|--------------------------------------------------------------------------
| Login Routes
|--------------------------------------------------------------------------
*/
Route::get('login', 'user@login');
Route::post('login', 'user@login');
Route::get('register', 'user@register');
Route::post('register', 'user@register');
Route::get('forgot', 'user@forgot');
Route::post('forgot', 'user@forgot');
Route::get('password', 'user@password');
Route::post('password', 'user@password');
Route::get('edit', 'user@edit');
Route::post('edit', 'user@edit');
Route::get('logout', 'user@logout');