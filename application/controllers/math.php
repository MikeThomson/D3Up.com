<?php

class Math_Controller extends Base_Controller {
	public $restful = true;
	public $layout = 'template.main';

	public function get_index() {
		$math = Epic_Mongo::db('math')->find();
		$this->layout->nest('content', 'math.index', array(
			'math' => $math,
			'lang' => Session::get('locale')
		));
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
		$this->layout->nest('content', 'math.create');
	}
	
	private function _validate() {
		// Get all Inputs
		$input = Input::all();
		// Validate all of the Inputs
		$rules = array(
	    'title' => 'required|between:5,100',
			'explanation' => 'between:5,100',
			'content' => 'required|between:5,10000',
			'locale' => 'required|in:' . implode(array_keys(Config::get('application.languages')), ","),
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
		$this->layout->nest('content', 'math.edit', array(
			'math' => $math,
			'language' => $lang
		));
	}
	
	public function post_edit() {
		$input = Input::all();
		$validation = $this->_validate();
		if($validation->fails()) {
			return Redirect::to('math/'.$input['id'].'/edit?language='.$input['locale'])->with_errors($validation);
		}
		$math = Epic_Mongo::db('math')->findOne(array("id" => (int) $input['id']));
		$math->saveRevision($input['locale']); 
		$math->_localized->$input['locale'] = array(
			'title' => $input['title'],
			'explanation' => $input['explanation'],
			'content' => $input['content'],
			'html' => Markdown::defaultTransform($input['content']),
			'timestamp' => time(),
		);
		// Had to do it this way so unittests could pass.
		if(!Request::cli()) {
			$math->_localized->$input['locale']['author'] = Auth::user()->username;
		}
		$math->save();
		return Redirect::to('/math/' . $math->id . '/edit');			
	}
	
	public function get_view($id) {
		// Get the ID from the Route
		$id = (int) $id;
		// Query for it
		$query = array('id' => $id);
		$math = Epic_Mongo::db('math')->findOne($query);
		if(!$math) {
			return Response::error('404');
		}
		$this->layout->nest('content', 'math.view', array(
			'math' => $math,
		));
	}
	
	public function get_delete($id) {
		$id = (int) $id;
		// Query for it
		$query = array('id' => $id);
		$math = Epic_Mongo::db('math')->findOne($query);
		if(!$math) {
			return Response::error('404');
		}
		$this->layout->nest('content', 'math.delete', array(
			'math' => $math,
		));
	}
	
	public function post_delete() {
		if($confirm = Input::get('confirm')) {
			if($confirm == 'true') {
				$id = (int) Input::get('id');
				// Query for it
				$query = array('id' => $id);
				$math = Epic_Mongo::db('math')->findOne($query);
				$math->delete();
				return Redirect::to_action('math@index');
			}
		}		
		throw new Exception("Unable to Delete");
	}
	
	public function get_history($id) {
		if(!Request::get('language')) {
			throw new Exception("A language must be specified to view revision history.");
		}
		$query = array(
			'lang' => Request::get('language'),
			"_originalId" => (int) $id,
		);
		$history = Epic_Mongo::db("math_revision")->find($query);
		$cursor = Epic_Mongo::db("math_revision")->find($query)->skip(0)->sort(array("_timestamp" => -1)); 
		// var_dump($cursor->export()); exit;
		$cursor->rewind();
		$selected = $cursor->current();
		$current = Epic_Mongo::db("math")->findOne(array("id" => (int) $id));
		$this->layout->nest('content', 'math.history', array(
			'current' => $current,
			'history' => $history
		));
	}
}