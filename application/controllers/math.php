<?php

class Math_Controller extends Base_Controller {
	public $restful = true;
	public function get_index() {
		return View::make('math.index');
	}
	public function get_create() {
		return View::make('math.create');
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
	
	public function post_create() {
		// Get all Inputs
		$input = Input::all();
		// Query for Existing Document		
		$query = array(
			'slug' => $this->slug($input['title']),
			'locale' => $input['locale'],
		);
		var_dump($query);
		$math = Epic_Mongo::db('math')->findOne($query);
		if(!$math) {
			// Create new if not found
			$math = Epic_Mongo::db('doc:math');
			$math->slug = $this->slug($input['title']);
		}
		$math->content = $input['content'];
		$math->html = Markdown::defaultTransform($input['content']);
		$math->title = $input['title'];
		$math->explanation = $input['explanation'];
		$math->locale = $input['locale'];
		$math->save();
		return View::make('math.create');
	}
}