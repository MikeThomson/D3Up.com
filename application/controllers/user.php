<?php

// Not sure where these should live yet, but not here...
Validator::register('username', function($attribute, $value, $parameters) {	
	return !Epic_Mongo::db('user')->findOne(array('username' => strtolower($value)));
});

Validator::register('battletag', function($attribute, $value, $parameters) {	
  $pattern = "/^[\p{L}\p{Mn}][\p{L}\p{Mn}0-9]{2,11}#[0-9]{4,5}+$/u";
  return (preg_match($pattern, $value)) ? true : false;
});

Validator::register('password_match', function($attribute, $value, $parameters) {	
	$user = Auth::user();
	return Hash::check($value, $user->password);
});


class User_Controller extends Base_Controller {

	public $restful = true;
	public $layout = 'template.main';
	
	public function get_index() {
		// Require Login
		if(!Auth::check()) {
			return Redirect::to('user/login');
		}
		$this->layout->nest('content', 'user.index', array(
			'user' => Auth::user()
		));
	}

	public function get_items() {
		// Require Login
		if(!Auth::check()) {
			return Redirect::to('user/login');
		}
		$this->layout->nest('content', 'user.items');
	}

	public function get_builds() {
		// Require Login
		if(!Auth::check()) {
			return Redirect::to('user/login');
		}
		$this->layout->nest('content', 'user.builds');
	}
	
	public function get_edit() {
		// Require Login
		if(!Auth::check()) {
			return Redirect::to('user/login');
		}
		$this->layout->nest('content', 'user.edit');
	}
	
	public function post_edit() {
		// Require Login
		if(!Auth::check()) {
			return Redirect::to('user/login');
		}
		$user = Auth::user();
		// Get Valid Data from Input
		$data = array(
			'battletag' => Input::get('battletag'),
			'region' => Input::get('region'),
		);
		// Define the Validation Rules for User Data
		$rules = array(
	    'battletag' => 'battletag',
			'region' => 'integer',
		);
		// Validation Errors
		$messages = array(
		    'battletag' => 'Invalid Battle Tag, please use Name#1234 (with no spaces).',
		);
		$validation = Validator::make($data, $rules, $messages);
		if ($validation->fails()) {
			return Redirect::to('/user')->with_errors($validation)->with_input();
		}
		foreach($data as $k => $v) {
			if($v) {
				$user->$k = strtolower($v);
			}
		}
		$user->save();
		return Redirect::to('/user');
	}
	
	public function get_password() {
		// Require Login
		if(!Auth::check()) {
			return Redirect::to('user/login');
		}
		$this->layout->nest('content', 'user.password');
	}
	
	public function post_password() {
		// Require Login
		if(!Auth::check()) {
			return Redirect::to('user/login');
		}
		// Get all the Inputs 
		$input = Input::all();
		$rules = array(
	    'current' => 'required|between:4,50|password_match',
			'password'  => 'required|confirmed|between:4,50',
			'password_confirmation'  => 'required|between:4,50',
		);
		$validation = Validator::make($input, $rules);
		if ($validation->fails()) {
			return Redirect::to('password')->with_errors($validation)->with_input();
		}
		$user = Auth::user();
		$user->password = Hash::make($input['password']);
		$user->save();
		return Redirect::to("/user/");
	}
	
	public function get_login() {
		// If we're already logged in, send em to the homepage
		if(Auth::check()) {
			return Redirect::to('user/login');
		}
		// Set the layout to modal for this page
		$this->layout = View::make('template.modal');
		// Render the Login View
		$this->layout->nest('content', 'user.login');
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
		// Set the layout to modal for this page
		$this->layout = View::make('template.modal');
		// Embed the Registration view
		$this->layout->nest('content', 'user.register');
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
		throw new Exception("Forgot Password not implemented yet");		
	}
}