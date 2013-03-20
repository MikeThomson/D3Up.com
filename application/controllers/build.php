<?php

class Build_Controller extends Base_Controller {

	public $restful = true;

	public function get_index() {
		// Build List Parameters
		$curPage = Request::get('page') ?: 1;	// Either the currently requested page, or if null, page #1
		$perPage = 20;
		$skip = ($curPage - 1) * $perPage;
		// Filtering on the Build List
		$query = array();
		// Do we have a class specified?
		if($class = Request::get('class')) {
			$query['class'] = $class;
		}
		// How are we sorting them?
		$sort = array(
			'_created' => -1
		);
		// Fetch the Builds
		$builds = Epic_Mongo::db('build')->find($query)->sort($sort);
		$pagination = Paginator::make($builds->limit($perPage)->skip($skip), $builds->count(), $perPage);
		$pagination->appends(array(
			'class' => Request::get('class'),
			'sort' => Request::get('sort'),
		));
		return View::make('build.index')->with('builds', $builds)->with('pagination', $pagination);
	}

	public function get_view($id, $data = false) {
		$build = Epic_Mongo::db('build')->findOne(array('id' => (int) $id));
		if(!$build) {
			return Response::error('404');
		}
		return View::make('build.view')->with('build', $build);
	}
	
	public function get_compare($id1, $id2) {
		$build1 = Epic_Mongo::db('build')->findOne(array('id' => (int) $id1));
		$build2 = Epic_Mongo::db('build')->findOne(array('id' => (int) $id2));
		if(!$build1 || !$build2) {
			return Response::error('404');
		}
		return View::make('build.compare')->with('build1', $build1)->with('build2', $build2);
	}
	
	public function get_sync($id, $data = false) {
		// Get the Build
		$build = Epic_Mongo::db('build')->findOne(array('id' => (int) $id));
		// Sync the Build and get the results
		$results = $build->sync();
		// Return the Results and Build to the View
		return View::make('build.sync')->with('build', $build)->with('results', $results);
	}
	
	public function get_create() {
		// Are we requesting characters?
		$bt = Input::get('battletag');
		$rg = Input::get('region');
		if($bt && $rg && Request::ajax()) {
			$sync = new D3Up_Sync();
			return Response::json($sync->getCharacters($rg, $bt));
		}
		// Are we logged in with characters?
		$characters = array();
		if($user = Auth::user()) {
			if($user->region && $user->battletag) {
				$sync = new D3Up_Sync();
				$characters = $sync->getCharacters($user->region, $user->battletag);
			}
		}
		// Return the View
		return View::make('build.create')
							 ->with('characters', $characters);
	}
	
	public function post_create() {
		// Create a new Build
		$build = Epic_Mongo::db('doc:build');
		// Set the Custom Options passed in the Form
		$build->name = Input::get('name');
		$build->class = Input::get('class');
		$build->level = (int) Input::get('level');
		$build->paragon = (int) Input::get('paragon');
		$build->_created = time();
		// Save this data on the Build
		$build->save();
		// Are we sync'ing this build?
		if(Input::get('character-id') && Input::get('character-bt') && Input::get('character-rg')) {
			// Set the Battle.net Information on the Build
			$build->_characterRg = Input::get('character-rg');
			$build->_characterBt = Input::get('character-bt');
			$build->_characterId = Input::get('character-id');
			// Sync the Data from Battle.net
			$results = $build->sync();
			// Return the Sync view
			return View::make('build.sync')->with('build', $build)->with('results', $results);
		}
		// Redirect to the build
		return Redirect::to_action('build@view', array('id' => $build->id));
	}

}