<?php

class User_Controller extends Base_Controller {

	public $restful = true;
	
	public function get_login() {
		// If we're already logged in, send em to the homepage
		if(Auth::check()) {
			return Redirect::to('/');
		}
		// Render the Login View
		return View::make('user/login');
	}
	
	public function post_login() {
		// If we're already logged in, send em to the homepage		
		if(Auth::check()) {
			return Redirect::to('/');
		}
		// Setup the Query for the Login
		$data = array(
			'email' => Input::get('email'),
			'password' => Input::get('password'),
		);
		// Attempt to Authenticate
		if(Auth::attempt($data)) {
			Cookie::forever('d3up_user', Auth::user()->id);
			// We logged in successfully, redirect to the homepage
			return Redirect::to('/');
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
	    'email' => 'required|email',
			'password'  => 'required|between:8,50',
			'key' => 'match:/beta/',
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
	}
	
	public function get_logout() {
		Cookie::forget('d3up_user');
		Auth::logout();
		return Redirect::to('login');
	}

	public function get_items() {
		return View::make('user.items');
	}
}