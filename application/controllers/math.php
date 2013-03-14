<?php

class Math_Controller extends Base_Controller {
	public $restful = true;
	public function get_index() {
		return View::make('math.index');
	}
	
	public function slug($text) {
		$regex = array(
              '/ä/' => 'ae',
              '/ö/' => 'oe',
              '/ü/' => 'ue',
              '/Ä/' => 'Ae',
              '/Ö/' => 'Oe',
              '/Ü/' => 'Ue',
              '/ß/' => 'ss',
           '/\'s/i' => 's',
    '/[^a-z0-9]+/i' => '-', 
             '/-+/' => '-', 
             '/^-/' => '', 
             '/-$/' => '',
    );
    return preg_replace(array_keys($regex), array_values($regex), mb_strtolower($text));
	}
	
	public function get_create() {
		return View::make('math.create');
	}
	
	private function _validate() {
		// Get all Inputs
		$input = Input::all();
		// Validate all of the Inputs
		$rules = array(
	    'title' => 'required|between:5,100',
			'explanation' => 'between:5,100',
			'content' => 'required|between:5,1000',
		);
		return Validator::make($input, $rules);
	}
	
	public function post_create() {
		// Validate the Inputs
		$validation = $this->_validate();
		if($validation->fails()) {
			return Redirect::to('math/create')->with_errors($validation)->with_input();
		}
		
		// Get all Inputs
		$input = Input::all();

		$math = Epic_Mongo::db('doc:math');
		$math->title = $input['title'];
		$math->slug = $this->slug($input['title']);
		if(!$math->_localized) {
			$math->_localized = Epic_Mongo::db('doc:localized');
		}
		$math->_localized->$input['locale'] = array(
			'title' => $input['title'],
			'explanation' => $input['explanation'],
			'content' => $input['content'],
			'html' => Markdown::defaultTransform($input['content']),
		);
		$math->_created = time();
		$math->save();
		if($math->id) {
			return Redirect::to('/math/' . $math->id);			
		}
	}
	
	public function get_edit($id) {
		$id = (int) $id;
		// Query for it
		$query = array('id' => $id);
		$math = Epic_Mongo::db('math')->findOne($query);
		// Determine which language we're trying to edit
		$lang = Request::get('language'); 
		// Return the View
		return View::make('math.edit')->with('math', $math)->with('language', $lang);			
	}
	
	public function post_edit() {
		$validation = $this->_validate();
		if($validation->fails()) {
			return Redirect::to('math//edit')->with_errors($validation)->with_input();
		}
		$input = Input::all();
		$math = Epic_Mongo::db('math')->findOne(array("id" => (int) $input['id']));
		$math->_localized->$input['locale'] = array(
			'title' => $input['title'],
			'explanation' => $input['explanation'],
			'content' => $input['content'],
			'html' => Markdown::defaultTransform($input['content']),
		);
		$math->save();
		return Redirect::to('/math/' . $math->id . '/edit');			
	}
	
	public function get_view($id) {
		// Get the ID from the Route
		$id = (int) $id;
		// Query for it
		$query = array('id' => $id);
		$math = Epic_Mongo::db('math')->findOne($query);
		if($math) {
			return View::make('math.view')->with('math', $math);			
		} else {
			return Redirect::to('/math');
		}
		
		
		var_dump(Input::all(), $id, $math); exit;
	}
}