<?php

class D3Up_Sync {

	// Item Data URL
	public $urlItem = 'http://us.battle.net/api/d3/data/item/';

	// Profile Data URL
	public $urlProfile = array(
		1 => 'http://us.battle.net/api/d3/profile/',
		2 => 'http://eu.battle.net/api/d3/profile/',
		3 => 'http://kr.battle.net/api/d3/profile/',
	);

	// Fetch the Data from the specified URL
	protected function _getData($url) {
		// Flag for Aborting the Process
		$abort = false;
		// How many times we've already tried
		$tries = 0;
		// The limit of the number of tries
		$limit = 5;
		// A null context for the request, will be loaded with proxy settings if specified
		$context = null;
		// While we're not aborting, try to fetch specified URL
		while($abort === false) {
			// Do we have an application.proxy? Set it up!
			if(Config::has('application.proxy')) {
				$context = $this->_getProxyContext(Config::get('application.proxy'));
			}
			// Attempt to load the JSON from the URL
	    if($json = file_get_contents($url, false, $context)) {
				// Success, return JSON
				return json_decode($json, true);
			} else {
				// Increment the Counter and try again
				$tries++;				
			}
			// If we've exceeded our limit on tries, throw the exception.
			if($tries >= $limit) {
				// Failed, abort lookup
				$abort = true;
				// Throw the exception
				throw new Exception("Failed loading Battle.net Armory API. Tried ".$tries."/".$limit." times on ".$url);
			}
		}
	}
	
	protected function _getProxyContext($host) {
		// Define the Proxy Context
		$aContext = array(
			'http' => array(
				'proxy' => $host,
				'request_fulluri' => true,
			),
		);
		// Return the Stream with the Context
		return stream_context_create($aContext);
	}
	// Check to make sure the proper data is on the build for the sync
	protected function _canSync() {
		// Get the Build
		$build = $this->getBuild();
		// Check to see if the BattleTag, Region and ID are set
		if(!$build->_characterBt || !$build->_characterRg || !$build->_characterId) {
			// If not, return false.
			return false;			
		}
		return true;
	}
	
	// Storage for the Build
	protected $_build = false;
	
	// Set the Build
	public function setBuild(D3Up_Build $build) {
		$this->_build = $build;
	}
	
	// Get the Build
	public function getBuild() {
		return $this->_build;
	}

	// Runs the Sync against a Build
	public function run(D3Up_Build $build) {
		// Store the Build on the Object
		$this->setBuild($build);
		// Check to see if we can even sync this build
		if($this->_canSync()) {
			return $this->_sync();
		}
		// Throw an exception if we cannot sync
		throw new Exception("This build cannot be sync'd with Battle.net, it was created from scratch without the proper information. Please edit the build and fill out the proper information to allow it to sync.");
	}
	
	// The steps needed to sync a build
	protected function _sync() {
		// Fetch the Profile API information about the Hero
		$json = $this->_getData($this->_profileUrl());	
		// Set the Meta Information on the Build	
		$build = $this->_setMeta($json);
		// Set the Active Skills on the Build
		$build->actives = $this->_getActives($json);
		// Set the Passive Skills on the Build
		$build->passives = $this->_getPassives($json);
		// TODO - Items, more?
		var_dump($build->export()); exit;
	}
	
	protected function _setMeta(array $json) {
		$build = $this->getBuild();
		// Set the time of this sync
		$build->_lastCrawl = time();
		// Incremenent the number of times this build has been sync'd
		$build->crawlCount++;
		// Set the Level of the Character
		$build->level = (int) $json['level'];
		// Set the Paragon Level of the Character
		$build->hardcore = (bool) $json['hardcore'];
		// Set the Hardcore Status of the Character
		$build->paragon = (int) $json['paragonLevel'];
		// Return the Build
		return $build;
	}
	
	protected function _getActives(array $json) {
		$skills = array();
		// Loop through the API's active skills and build the D3UP string representation
		foreach($json['skills']['active'] as $idx => $skill) {
			if(isset($skill['skill'])) {
				$current = $skill['skill']['slug'];
				// If we have a rune, append it on with a ~ and the alpha index
				if(isset($skill['rune'])) {
					$parts = explode("-", $skill['rune']['slug']);
					$parts = array_reverse($parts);
					$current .= "~" . $parts[0];
				}
				$skills[$idx] = $current;		    
			}
		}
		return $skills;
	}

	// 
	protected function _getPassives(array $json) {
		$passives = array();
		// Loop through the API's passive skills and build the D3UP string representation
		foreach($json['skills']['passive'] as $skill) {
			if(isset($skill['skill'])) {
				$passives[] = $skill['skill']['slug'];					    
			}
		}
		return $passives;
	}
	
	// Builds the URL to the profile of the loaded build
	public function _profileUrl() {
	  return $url = 
			$this->urlProfile[$this->getBuild()->_characterRg] 
			. strtolower(str_replace("#", "-", $this->getBuild()->_characterBt)) 
			. "/hero/" . $this->getBuild()->_characterId;		
	}
}