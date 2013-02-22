<?php

/*
|--------------------------------------------------------------------------
| D3Up.com Specific Routing
|--------------------------------------------------------------------------
*/

// Builds a route to a build
Route::get('/b/(:num)/(:any?)', 'build@view');

// Detect Controllers and Build Routes for them
Route::controller(Controller::detect());

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
Route::get('login', function() {
	if(Auth::check()) {
		return Redirect::to('/');
	}
	return View::make('user/login');
});

Route::post('login', function() {
	if(Auth::check()) {
		return Redirect::to('/');
	}
	// get POST data
	$data = array(
		'username' => Input::get('email'),
		'password' => Input::get('password'),
	);
	if ( Auth::attempt(Input::all()) ) {
		// we are now logged in, go to home
		return Redirect::to('/');
	} else {
	// auth failure! lets go back to the login
	return Redirect::to('login')
	  ->with('login_errors', true)
		->with_input('only', array('email'));
}});

Route::get('register', function() {
	throw new Exception("Registration currently Disabled.");
	if(Auth::check()) {
		return Redirect::to('/');
	}
	return View::make('user/register');
});

Route::post('register', function() {
	if(Auth::check()) {
		return Redirect::to('/');
	}
	$input = Input::all();
	$rules = array(
    'email' => 'required|email',
		'password'  => 'required|between:8,50',
		'key' => 'match:/jestasays/',
	);
	$validation = Validator::make($input, $rules);
	if ($validation->fails()) {
		return Redirect::to('register')->with_errors($validation)->with_input();
	}
	$user = Epic_Mongo::db('doc:user');
	$user->email = $input['email'];
	$user->password = Hash::make($input['password']);
	$user->save();
	return Redirect::to('/');
});

Route::get('logout', function() {
	Auth::logout();
	return Redirect::to('login');
});