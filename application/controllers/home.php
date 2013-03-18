<?php

class Home_Controller extends Base_Controller {

	public function action_index()
	{
		return View::make('home.index');
	}
	
	public function action_apistatus() {
		if(Cache::has('api-status')) {
			$available = Cache::get('api-status');
		} else {
			$sync = new D3Up_Sync();
			$available = array();
			foreach(array(1,2,3) as $region) {
				$build = Epic_Mongo::db('build')->findOne(array("_characterRg" => (string) $region));
				if($build) {
					$characters = $sync->getCharacters($build->_characterRg, $build->_characterBt);
					$available[$region] = (bool) $characters;					
				}
			}			
			$available = Cache::put('api-status', $available, 5);
		}
		return View::make('home.api-status')->with('status', $available);
	}

}