<?php

// Not sure where these should live yet, but not here...
Validator::register('username', function($attribute, $value, $parameters) {	
	return !Epic_Mongo::db('user')->findOne(array('username' => strtolower($value)));
});

class User_Controller extends Base_Controller {

	public $restful = true;
	
	public function get_index() {
		// Require Login
		if(!Auth::check()) {
			return Redirect::to('user/login');
		}
		return View::make('user/index');
	}

	public function get_items() {
		// Require Login
		if(!Auth::check()) {
			return Redirect::to('user/login');
		}
		return View::make('user.items');
	}

	public function get_builds() {
		// Require Login
		if(!Auth::check()) {
			return Redirect::to('user/login');
		}
		return View::make('user.builds');		
	}
	
	public function get_login() {
		// If we're already logged in, send em to the homepage
		if(Auth::check()) {
			return Redirect::to('user/login');
		}
		// Render the Login View
		return View::make('user/login');
	}
	
	public function post_login() {
		// If we're already logged in, send em to the homepage		
		if(Auth::check()) {
			return Redirect::to('user/login');
		}
		// Setup the Query for the Login
		$data = array(
			'email' => Input::get('email'),
			'password' => Input::get('password'),
		);
		// Attempt to Authenticate
		if(Auth::attempt($data)) {
			Cookie::forever('d3up_user', Auth::user()->id);
			// We logged in successfully, redirect to user dashboard
			return Redirect::to('user/index');
		} else {
			// Authentication Failure, redirect to the login form with errors and only the email address input
			return Redirect::to('login')
			  ->with('login_errors', true)
				->with_input('only', array('email'));
		}
	}
	
	public function get_register() {
		// If we're already logged in, send em to the homepage				
		if(Auth::check()) {
			return Redirect::to('/');
		}
		// Render the Registration view
		return View::make('user/register');
	}
	
	public function post_register() {
		// If we're already logged in, send em to the homepage		
		if(Auth::check()) {
			return Redirect::to('/');
		}
		// Get all the Inputs 
		$input = Input::all();
		$rules = array(
	    'username' => 'required|alpha_dash|between:2,50|username',
			'password'  => 'required|between:4,50',
	    'email' => 'email',
			'key' => 'required|match:/beta/',
		);
		$validation = Validator::make($input, $rules);
		if ($validation->fails()) {
			return Redirect::to('register')->with_errors($validation)->with_input();
		}
		$user = Epic_Mongo::db('doc:user');
		// TODO - Fix EpicMongo to support this.
		// $user->_id = $input['username'];
		$user->username = strtolower($input['username']);
		if($input['email']) {
			$user->email = strtolower($input['email']);
		}
		$user->password = Hash::make($input['password']);
		$user->save();
		if(Auth::attempt(array(
			'email' => $input['username'],
			'password' => $input['password']
		))) {
			return Redirect::to('user/index');
		}
		return Redirect::to('/login');
	}
	
	public function get_logout() {
		Cookie::forget('d3up_user');
		Auth::logout();
		return Redirect::to('login');
	}
	
	public function get_forgot() {
		throw new Exception("Forgot Password not implemented yet");
	}
	
	public function post_forgot() {
		
	}
}