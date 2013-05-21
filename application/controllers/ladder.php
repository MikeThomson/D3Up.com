<?php

class Ladder_Controller extends Base_Controller {
	
	public $restful = true;
	public $layout = 'template.main';
	
	public function getLadder($id = 1) {
		// Some hacky stuff here, it forces the ladder to exist, but could be
		//   abstracted for multiple ladders at once in the future
		$ladder = Epic_Mongo::db('ladder')->findOne(array('id' => $id));
		if(!$ladder) {
			// Not existing yet, make it (Again, this is dirty)
			$ladder = Epic_Mongo::db('doc:ladder');
			$ladder->id = 1;
			$ladder->save();
		}
		return $ladder;
	}
	
	public function get_index() {
		$ladder = $this->getLadder();
		// $builds = array();
		// foreach(array(1,2,500,501,502) as $id) {
		// 	$builds[$id] = Epic_Mongo::db('build')->findOne(array('id' => $id));
		// 	$ladder->builds->setProperty(null, $builds[$id]);
		// }
		// $ladder->save();
		$this->layout->nest('content', 'ladder.index', array(
			'ladder' => $ladder
		));
	}

	public function get_characters() {
		// Are we requesting characters?
		$bt = Input::get('battletag');
		$rg = Input::get('region');
		// If we have valid request data and this is an ajax request
		if($bt && $rg) { //} && Request::ajax()) {
			// Load up the Sync tool
			$sync = new D3Up_Sync();
			// Get all characters from this battletag
			$characters = $sync->getCharacters($rg, $bt);
			// Filter the characters to only return those whose level is 1
			$valid = array_filter($characters, function($char) {
				return(1 === $char['level']);
			});
			// Spit out the JSON response
			return Response::json($valid);
		}
		return Response::json(array('error' => 'Invalid Request'));
	}

	public function get_join() {	
		// Are we logged in with characters?
		$characters = array();
		if($user = Auth::user()) {
			if($user->region && $user->battletag) {
				$sync = new D3Up_Sync();
				$characters = $sync->getCharacters($user->region, $user->battletag);
				// Filter the characters to only return those whose level is 1
				$characters = array_filter($characters, function($char) {
					return(1 === $char['level']);
				});				
			}
		}	
		$this->layout->nest('content', 'ladder.join', array(
			'characters' => $characters
		));
	}
	
	public function post_join() {
		// Some validators... 
		$input = Input::all();
		$rules = array(
			'name' => 'required|between:2,70',
	    'class' => 'required|in:barbarian,demon-hunter,monk,wizard,witch-doctor',
			'level' => 'match:/1/',
			'paragon' => 'match:/0/',
		);
		$validation = Validator::make($input, $rules);
		if ($validation->fails()) {
			var_dump($validation); exit;
			return Redirect::to('/ladder/join')->with_errors($validation)->with_input();
		}
		// Grab out Ladder
		$ladder = $this->getLadder();
		// Create a new Build
		$build = Epic_Mongo::db('doc:build');
		$build->name = $input['name'];
		$build->ladder = $ladder;
		// Set the Battle.net Information on the Build
		$build->_characterRg = Input::get('character-rg');
		$build->_characterBt = strtolower(str_replace("-","#", Input::get('character-bt')));	// Ensure it's always lower and has # instead of - in it
		$build->_characterId = Input::get('character-id');
		// Is this build already in the ladder?
		// 	(Somewhat ugly of a check, but I can refactor later, proof of concept...)
		$query = array(
			'ladder' => $ladder->createReference(),
			'_characterBt' => $build->_characterBt,
			'_characterRg' => $build->_characterRg, 
			'_characterId' => $build->_characterId,
		);
		if(Epic_Mongo::db('build')->findOne($query)) {
			$build->delete();			
			throw new Exception("This character already exists in the ladder.");
		}
		// Sync the Data from Battle.net
		$results = $build->sync();
		// Now ensure what we sync'd is level 1 and paragon 0
		if($build->level !== 1 || $build->paragon !== 0) {
			$build->delete();
			throw new Exception("Invalid Character, it must be level 1 and paragon 0.");
		}
		// Success! Add this build to the ladder
		$ladder->builds->setProperty(null, $build);
		$ladder->save();
		// Return to the Success view
		return Redirect::to_action('ladder@index')
												->with('added', $build->id);
	}

	public function get_syncbuilds() {
		// Get the Ladder
		$ladder = $this->getLadder();
		// Get the most out of date build
		$query = array(
			'ladder' => $ladder->createReference(),
			'_lastCrawl' => array(
				'$lt' => time() - (60 * 60)	// Only builds that haven't been synced in the last hour
			)
		);
		$build = Epic_Mongo::db('build')
						->find($query)
						->sort(array('_lastCrawl' => 1))
						->limit(1);
		if(!$build->count()) {
			// If we had no builds, just exit.
			exit;
		}
		$build->rewind();
		$build = $build->current();
		if(!$build) {
			return Response::error('404');
		}
		// Sync the Build and get the results
		$results = $build->sync('ladder', true);
		// Embed the Results and Build into the View
		$this->layout->nest('content', 'build.sync', array(
			'build' => $build,
			'results' => $results
		));
		
	}
}