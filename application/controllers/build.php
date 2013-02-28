<?php

class Build_Controller extends Base_Controller {

	public function action_view($id, $data = false) {
		$build = Epic_Mongo::db('build')->findOne(array('id' => (int) $id));
		if(!$build) {
			return Response::error('404');
		}
		return View::make('build.view')->with('build', $build);
	}
	
	public function action_sync($id, $data = false) {
		// Sync this Build
		$build = Epic_Mongo::db('build')->findOne(array('id' => (int) $id));
		// Sync new Build
		// $build = Epic_Mongo::db('doc:build');
		// $build->_characterRg = 1;
		// $build->_characterBt = 'jesta#1121';
		// $build->_characterId = 1107072;
		// $build->_created = time(); 
		
		$results = $build->sync();
		return View::make('build.sync')->with('build', $build)->with('results', $results);
	}
	
	public function action_create() {
		$characters = array();
		return View::make('build.create')
								->with('characters', $characters);
	}

}