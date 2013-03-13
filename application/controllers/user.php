<?php

class User_Controller extends Base_Controller {
	public $restful = true;
	
	public function get_login() {
		if(Auth::check()) {
			return Redirect::to('/');
		}
		return View::make('user/login');
	}
	
	public function post_login() {
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
		}
	}
	
	public function get_register() {
		throw new Exception("Registration currently Disabled.");
		if(Auth::check()) {
			return Redirect::to('/');
		}
		return View::make('user/register');
	}
	
	public function post_register() {
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
	}
	
	public function get_logout() {
		Auth::logout();
		return Redirect::to('login');
	}
	
}