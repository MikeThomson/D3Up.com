<?php

/*
|--------------------------------------------------------------------------
| D3Up.com Specific Routing
|--------------------------------------------------------------------------
*/


// Route to Sync a Build
Route::get('/b/(:num)/sync', 'build@sync');
// Route to View a build
Route::get('/b/(:num)/(:any?)', 'build@view');

// Detect Controllers and Build Routes for them
Route::controller(Controller::detect());

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
Route::get('logout', 'user@logout');