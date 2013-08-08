<?php

class Home_Controller extends Base_Controller {

	public $layout = 'template.tuktuk';

	public function action_index()
	{
		$this->layout->nest('content', 'home.index');
	}
	
	public function action_cacheCheck() {
		return View::make('home.cache-check');
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
		$this->layout->nest('content', 'home.api-status', array(
			'status' => $available
		));
	}

	public function action_faq($slug) {
		$this->layout->nest('content', 'home.faq', array(
			'faq' => $slug
		));
	}
}