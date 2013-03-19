<?php

class Home_Controller extends Base_Controller {

	public function action_index()
	{
		return View::make('home.index');
	}
	

	protected $_statusURLs = array(
		'us' => 'http://us.battle.net/api/d3/data/follower/scoundrel',
		'eu' => 'http://eu.battle.net/api/d3/data/follower/scoundrel',
		'kr' => 'http://kr.battle.net/api/d3/data/follower/scoundrel',
		'tw' => 'http://tw.battle.net/api/d3/data/follower/scoundrel',
	);
	
	public function action_apistatus() {
		if(Cache::has('api-status')) {
			$available = Cache::get('api-status');
		} else {
			$sync = new D3Up_Sync();
			$available = array();
			foreach($this->_statusURLs as $region => $url) {
				if($sync->testURL($url)) {
					$available[$region] = true;
				} else {
					$available[$region] = false;					
				}
			}			
			Cache::put('api-status', $available, 5);
			Cache::put('api-status-checked', time(), 5);
		}
		return View::make('home.api-status')->with('status', $available);
	}

}