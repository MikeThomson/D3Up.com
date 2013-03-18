<?php

class Build_Controller extends Base_Controller {

	public function action_index() {
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