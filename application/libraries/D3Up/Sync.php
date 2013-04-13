<?php

class D3Up_Sync {

	// Storage for Log Messages
	protected $_log = array();
	// Storage for the fatal stopping error
	protected $_fatal = null;
	// Should the logger be disabled? (Used to remove unwanted dupes for gearsetcache)
	protected $_logEnabled = true;
	// What kind of sync is this?
	protected $_syncType = null;
	
	// Item Data URL
	public $urlItem = 'http://us.battle.net/api/d3/data/';

	// Profile Data URL
	public $urlProfile = array(
		1 => 'http://us.battle.net/api/d3/profile/',
		2 => 'http://eu.battle.net/api/d3/profile/',
		3 => 'http://kr.battle.net/api/d3/profile/',
	);
	
	// Map the Slot Types to D3Up's version
	protected $_slotMap = array(  
		'head' => 'helm',             
		'torso' => 'chest',           
		'feet' => 'boots',            
		'hands' => 'gloves',          
		'shoulders' => 'shoulders',   
		'legs' => 'pants',            
		'bracers' => 'bracers',       
		'mainHand' => 'mainhand',     
		'offHand' => 'offhand',       
		'waist' => 'belt',            
		'rightFinger' => 'ring2',     
		'leftFinger' => 'ring1',      
		'neck' => 'amulet',           
	);
	
	// Map the Type of Items from Armory (left) to D3Up (right)
	// Note - Notice how there's multiple 'types' for the same thing on Blizzard's side, like 'belt_barbarian' and 'mightybelt', 
	// 				these are both the d3up type of 'mighty-belt'. 
	protected $_armoryTypes = array(
		'amulet' => 'amulet',
		'belt' => 'belt',
		'boots' => 'boots',
		'bracers' => 'bracers',
		'chestarmor' => 'chest',
		'genericchestarmor' => 'chest',
		'cloak' => 'cloak',
		'gloves' => 'gloves',
		'helm' => 'helm',
		'pants' => 'pants',
		'legs' => 'pants',
		'belt_barbarian' => 'mighty-belt',
		'mightybelt' => 'mighty-belt',
		'ring' => 'ring',
		'shoulders' => 'shoulders',
		'spiritstone' => 'spirit-stone',
		'spiritstone_monk' => 'spirit-stone',
		'voodoomask' => 'voodoo-mask',
		'wizardhat' => 'wizard-hat',
		'2hmace' => '2h-mace',
		'mace2h' => '2h-mace',
		'2haxe' => '2h-axe',
		'axe2h' => '2h-axe',
		'bow' => 'bow',
		'daibo' => 'daibo',
		'combatstaff' => 'daibo',
		'crossbow' => 'crossbow',
		'2hmighty' => '2h-mighty',
		'mighty2h' => '2h-mighty',
		'mightyweapon2h' => '2h-mighty',
		'polearm' => 'polearm',
		'staff' => 'staff',
		'2hsword' => '2h-sword',
		'sword2h' => '2h-sword',
		'axe' => 'axe',
		'ceremonial-knife' => 'ceremonial-knife',
		'ceremonialdagger' => 'ceremonial-knife',
		'handcrossbow' => 'hand-crossbow',
		'handxbow' => 'hand-crossbow',
		'dagger' => 'dagger',
		'fistweapon' => 'fist-weapon',
		'mace' => 'mace',
		'mightyweapon' => 'mighty-weapon',
		'mightyweapon1h' => 'mighty-weapon',
		'spear' => 'spear',
		'sword' => 'sword', 
		'wand' => 'wand',
		'mojo' => 'mojo',
		'source' => 'source',
		'orb' => 'source',
		'quiver' => 'quiver',
		'shield' => 'shield',
	);
	
	// Determine the quality of the item based on the color
	protected $_qualityMap = array(
		4 => 'blue',
		5 => 'yellow',
		6 => 'orange',
		7 => 'green',
	);
	
	protected function _log($message, $type = 'info') {
		// If logging is disabled, don't do anything
		if($this->_logEnabled === false) {
			return null;
		}
		$msg = new stdClass();
		if($type == 'fatal') {
			$this->_fatal = $message;
		} else {
			$msg->message = $message;
			$msg->type = $type;			
			array_push($this->_log, $msg);
		}
	}

	// Fetch the Data from the specified URL
	protected function _getData($url) {
		$this->_log("Accessing API @ <a href='".$url."'>" . $url . "</a>");
		// Flag for Aborting the Process
		$abort = false;
		// How many times we've already tried
		$tries = 0;
		// The limit of the number of tries
		$limit = 5;
		// A null context for the request, will be loaded with proxy settings if specified
		$context = stream_context_create(array(
			'http' => array(
				'ignore_errors' => true,
				'max_redirects' => 0,
			),
		));
		// While we're not aborting, try to fetch specified URL
		while($abort === false) {
			// Do we have an application.proxy? Set it up!
			if(Config::has('application.proxy')) {
				$context = $this->_getProxyContext(Config::get('application.proxy'));
			}
			// Attempt to load the JSON from the URL
	    if($json = file_get_contents($url, false, $context)) {
				// Success, return JSON
				if(!json_decode($json, true)) {
					$this->_log("Failed parsing JSON from Battle.net @ <a href='".$url."'>" . $url . "</a>", "error");
					return null;
				} else {
					$this->_log("Successfully accessed JSON from Battle.net @ <a href='".$url."'>" . $url . "</a>", "success");
				}
				return json_decode($json, true);
			} else {
				// Increment the Counter and try again
				$tries++;				
			}
			// If we've exceeded our limit on tries, throw the exception.
			if($tries >= $limit) {
				// Failed, abort lookup
				$abort = true;
				$this->_log("Failed accessing Battle.net @ <a href='".$url."'>" . $url . "</a>", "error");
				// Throw the exception (Old Method)
				// throw new Exception("Failed loading Battle.net Armory API. Tried ".$tries."/".$limit." times on ".$url);
			}
		}
		$this->_log("Failed accessing Battle.net @ <a href='".$url."'>" . $url . "</a>", "error");
		return null;
	}
	
	protected function _getProxyContext($host) {
		// Define the Proxy Context
		$aContext = array(
			'http' => array(
				'proxy' => $host,
				'request_fulluri' => true,
				'ignore_errors' => true,
				'max_redirects' => 0,
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
			$this->_log("Build is missing one of: BattleTag, Region or ID. Please <a href='/b/".$build->id."/".($build->slug?:"~")."/edit'>edit the build</a> to correct this information.", "fatal");
			return false;			
		}
		// Check to see if this build has an owner, or just skip the check if the sync is being run via the command line (testing)
		if($build->_createdBy && !Request::cli()) {
			if($user = Auth::user()) {
				// If the user does NOT match the user that created the build, inform the user that they cannot sync it.
				if($user->id !== $build->_createdBy->id) {
					$this->_log("This build is owned by another user, you are not allowed to sync it.", "fatal");
					return false;
					// throw new Exception("This build is owned by another user, you are not allowed to sync it.");
				}
			} else {
				// If we aren't logged in and this build has a user, inform the user that they cannot sync it.
				$this->_log("This build is owned by a registered user, you are not allowed to sync it.", "fatal");
				return false;
				// throw new Exception("This build is owned by a registered user, you are not allowed to sync it.");
			}
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
	public function run(D3Up_Build $build, $type = null) {
		// Is this a specific sync type?
		$this->_syncType = $type;
		// Store the Build on the Object
		$this->setBuild($build);
		// Check to see if we can even sync this build
		if($this->_canSync()) {
			$this->_sync();
		}
		return array(
			'fatal' => $this->_fatal,
			'messages' => $this->_log
		);
	}
	
	// The steps needed to sync a build
	protected function _sync() {
		// Fetch the Profile API information about the Hero
		$this->_log("Beginning API requests for Character Information.");
		if($json = $this->_getData($this->_profileUrl())) {
			// Set the Meta Information on the Build	
			$build = $this->_setMeta($json);
			// If the syncType is "gear", don't bother with skills
			if($this->_syncType != "gear") {
				// Set the Active Skills on the Build
				$build->actives = $this->_getActives($json);
				// Set the Passive Skills on the Build
				$build->passives = $this->_getPassives($json);				
			}
			// If the syncType is "skills", don't bother with gear
			if($this->_syncType != "skills") {
				// Gather the Item Data needed
				$this->_log("Beginning API Requests for Item Information.");
				// Set gear as a GearSet_Cache (Embedded versions of the Items, will update when the item is saved)
				$build->gear = $this->_getGear($json);			
				// Set _gear as a GearSet (References to Actual Items)
				$this->_logEnabled = false;	// Disable Logging for this action
				$build->_gear = $this->_getGear($json, 'gearsetcache');
				$this->_logEnabled = true;	// Re-enable Logging for from here on out				
			}
		}	
		// Finally save the build
		$build->save(true);
	}
	
	protected function _getGear(array $json, $docType = 'gearset') {
		$gear = Epic_Mongo::db('doc:'.$docType);
		foreach($json['items'] as $slot => $meta) {
			$this->_log("Found item '".$meta['name']."' located in slot '".$slot."', checking to see if this item already exists...");
			// Determine what D3Up considered the slot as
			$d3upSlot = $this->_slotMap[$slot];
			// Does this item already exist as one of your items? Are we skipping this because of a forced refresh?
			if($this->_syncType != "forced" && $item = $this->_itemExists($meta['tooltipParams'])) {
				// If so, just set it
				$gear[$d3upSlot] = $item->cleanedFor($docType);
			} else {
				// Build the URL to fetch the item
				$url = $this->urlItem . $meta['tooltipParams'];
				// Fetch the data
				if($data = $this->_getData($url)) {
					// Build the Item into D3Up's structure
					$item = $this->_buildItem($data);
					// Set the slot as the item in the gearset
					$gear[$d3upSlot] = $item->cleanedFor($docType);
				}				
			}
		}
		// Return the Gearset
		return $gear;
	}
	
	protected function _itemExists($d3id) {
		// --------------------------------------------------------
		// Check for Item's Existence in relation to this person
		// --------------------------------------------------------
		$item = null;
		// Start building the Query
		$query = array(
			'_d3id' => $d3id,
		);
		// Check to see how we should query for the user portion
		if($user = Auth::user()) {
			// Check for a duplicate item already created by the user.
			$query['_createdBy'] = $user->createReference();
		} else {
			// Check for a version of this item where the _createdBy field doesn't exist
			$query['_createdBy'] = array('$ne' => true);
		}
		// Query for the Item
		$item = Epic_Mongo::db('item')->findOne($query);
		// --------------------------------------------------------
		// If we found the item, return it!
		// --------------------------------------------------------
		if($item) {
			$this->_log(HTML::itemLink($item)." located as one of your items in the database, skipping import and equipping.", "success");
		} else {
			$this->_log("Item not found, attempting import from Battle.net.");			
		}
		return $item;
	}
	
	protected function _buildItem($data) {
		$this->_log("Found item named: ".$data['name']);
		// --------------------------------------------------------
		// Not found? Lets go through all the steps to create it
		// --------------------------------------------------------
		// Create the Document
		$item = Epic_Mongo::db('doc:item');
		// Assign the D3ID (from TooltipParams)
		$item->_d3id = $data['tooltipParams'];
		// When it was created
		$item->_created = time();
		// Who created it
		if($user = Auth::user()) {
			// If we're a user, put our reference in
			$item->_createdBy = $user;
		}
		// Some string replacement to clean up the word generic and fix casing of how it's returned from the API
		$dirtyType = str_replace("generic", "", strtolower($data['type']['id']));
		// If we can't find it in the array, then throw an error!
		if(!isset($this->_armoryTypes[$dirtyType])) {
			throw new Exception("Unrecognized Item Type of '" . $dirtyType . "'! Please email me at <a href='mailto:aaron.cox@greymass.com'>aaron.cox@greymass.com</a> and let me know about this error message!");
		}
		// Set the Name
		$item->name = html_entity_decode($data['name']);
		// Set the Icon
		$item->icon = $data['icon'];
		// Set the Quality
		$item->quality = array_search($data['displayColor'], $this->_qualityMap);
		// Set the Type on the Item
		$item->type = $this->_armoryTypes[$dirtyType];
		// Is this item part of a set?
		if(isset($data['set']) && isset($data['set']['slug'])) {
			$item->set = $data['set']['slug'];				
		}
		// Parse the Stats of the item and set them (before the attrs, incase they need to modify these values)
		$item = $this->_buildItemStats($data, $item);
		// Parse the Attributes of the item and set them
		$item = $this->_buildItemAttrs($data, $item);
		// Parse the Socket information and set them
		$item = $this->_buildItemSockets($data, $item);
		// Save the item
		$item->save();
		// Display the item in the Log
		$this->_log("Created new item, ".HTML::itemLink($item), "success");		
		// Then return to the item
		return $item;
	}
	
	protected function _buildItemSockets(array $json, D3Up_Item $item) {
		// Return Value
		$return = array();
		// Set a placeholder stating we don't have a ruby in here
		$weaponRuby = false;
		// Loop through all gems in the JSON
		foreach($json['gems'] as $gem) {
			// If the gem has a name...
			if(isset($gem['item']['name'])) {
				// Slug it out to what D3Up uses
				$slug = strtolower(str_replace(" ", "_", $gem['item']['name']));
				// Get the actual gem data
				$actual = D3Up_Gems::$gems[$slug];
				// If this item has a ruby and has a DPS value, it's a weapon, and we need to adjust (see below)
				if(strpos($slug, 'ruby') && isset($json['dps']['min'])) {
					$weaponRuby = $actual[2][1];
				}
				// Store the slug of the gem in the return values
				$return[] = $slug;
			}
		}
		// If the weapon had a ruby and was a gem, we need to do some funky math to adjust the weapon value to it's real value :(
		if($weaponRuby) {
			// Do we have a +% Damage on the weapon? If so, add it to the ruby's value
			if(isset($item->attrs['plus-damage'])) {
				$weaponRuby *= 1 + ($item->attrs['plus-damage'] * 0.01);
			}
			// Subtract the Gem Values from the Min/Max Damage of the item (this is done in the calculator, doing it here would double it)
			$stats = $item->stats; 
			$stats['damage']['min'] -= $weaponRuby;
			$stats['damage']['max'] -= $weaponRuby;
			// Recalculate the Weapon's DPS without the Gem
			$stats['dps'] = round(($stats['damage']['min'] + $stats['damage']['max']) / 2 * $stats['speed'], 2);
			$item->stats = $stats;
		}
		// Set the Sockets
		$item->sockets = $return;
		// Return the Item
		return $item;
	}
	
	protected function _buildItemAttrs(array $json, D3Up_Item $item) {
		// Attributes to Return
		$return = array();
		// Language to use (en for now, need to adjust for multiple languages)
		$lang = 'en';
		// Loop through Attributes on the Item
		foreach($json['attributes'] as $attr) {
			// Scan through the D3Up_Attributes for a match
			foreach(D3Up_Attributes::$attributes[$lang] as $stat => $regex) {
				// Explode incase we have variations of the attribute
				$parts = explode("~", $stat);
				// The stat is always the first part of the variations
				$stat = $parts[0];
				// Replace mdash's and set it as the text
				$text = str_replace("–", "-", $attr);
				// Parse the Regex and replace [v] with digit searches and escape the + symbol for regex
				$regex = "/".str_replace(array('+', '[v]'), array('\+','(\d+(\.\d+)?)'), $regex)."/i";
				// If we have a match...
				if(preg_match($regex, $text, $matches)) {
					// If we have 3 matches, it's a min/max damage adjuster
					if(count($matches) > 3) {
						$return[$stat] = array(
							'min' => (float) $matches[1],
							'max' => (float) $matches[3],
						);
						// Adjust the stats that were already adjusted
						if(isset($item->stats['damage']) && isset($item->stats['damage']['min'])) {
							$item->stats['damage']['min'] += $matches[1];
						}
						if(isset($item->stats['damage']) && isset($item->stats['damage']['max'])) {
							$item->stats['damage']['max'] += $matches[3];
						}
					} else {
						// If we don't have a matches[1]
					  if(!isset($matches[1])) {
							// This is a true or false value
              $return[$stat] = true;
					  } else {
							// Otherwise it's a float
							$return[$stat] = (float) $matches[1];																					  					    
					  }
					}
					// Break the foreach because we found it's matching stat
					break;
				}
			}
		}
		// Fixes for Hidden Damage Attributes!
		if(isset($json['attributesRaw']) && isset($return['minmax-damage'])) {
			// If we have minmax damage already set from the item, lets see if there's a hidden +min or +max
			if(isset($json['attributesRaw']['Damage_Bonus_Min#Physical'])) {
				$return['min-damage'] = $json['attributesRaw']['Damage_Bonus_Min#Physical']['min'];
			}
			if(isset($json['attributesRaw']['Damage_Bonus_Max#Physical'])) {
				$return['max-damage'] = $json['attributesRaw']['Damage_Bonus_Max#Physical']['max'];
			}
		}
		// Set the attrs on the item
		$item->attrs = $return;
		// return the item
		return $item;
	}
	
	protected function _buildItemStats(array $json, D3Up_Item $item) {
		// Storage for Stats
		$return = array();
		// Does this item have armor, and it's not a ring or amulet?
		if(isset($json['armor']) && $item->type != "ring" && $item->type != "amulet") {
			$return['armor'] = (float) $json['armor']['min'];
		}
		// Does this item have a DPS value?
		if(isset($json['dps'])) {
			$return['dps'] = (float) $json['dps']['min'];					
		}
		// Does this item have a minimum and maximum damage?
		if(isset($json['minDamage']) && isset($json['maxDamage'])) {
			$return['damage'] = array(
				'min' => (float) $json['minDamage']['min'],
				'max' => (float) $json['maxDamage']['min'],
			);
		}
		// Does this item have a speed?
		if(isset($json['attacksPerSecond'])) {
			$return['speed'] = (float) $json['attacksPerSecond']['min'];		
		}
		// Does this item have a block chance?
		if(isset($json['blockChance'])) {
			$return['block-chance'] = $json['blockChance']['min'] * 100;
		}
		// Does this item have a block value?
		if(isset($json['attributesRaw']) && isset($json['attributesRaw']['Block_Amount_Item_Min']) && isset($json['attributesRaw']['Block_Amount_Item_Delta'])) {
			$return['block-amount'] = array(
				'min' => $json['attributesRaw']['Block_Amount_Item_Min']['min'],
				'max' => $json['attributesRaw']['Block_Amount_Item_Min']['min'] + $json['attributesRaw']['Block_Amount_Item_Delta']['min'],
			);
		}
		// Set the stats on the item
		$item->stats = $return;
		// Return the item
		return $item;
	}

	protected function _setMeta(array $json) {
		$build = $this->getBuild();
		// Set the time of this sync
		$build->_lastCrawl = time();
		// Set the time of the last battle.net update
		$build->_lastBnetUpdate = (int) $json['last-updated'];
		// If we're a user, put our reference in
		if($user = Auth::user()) {
			$build->_createdBy = $user;
		}		
		// Incremenent the number of times this build has been sync'd
		$build->crawlCount++;
		// Set the Class of the Character
		$build->class = $json['class'];
		// Set the Level of the Character
		$build->level = (int) $json['level'];
		// Set the Paragon Level of the Character
		$build->hardcore = (bool) $json['hardcore'];
		// Set the Hardcore Status of the Character
		$build->paragon = (int) $json['paragonLevel'];
		// Set the Gender of the Character
		$build->gender = (int) $json['gender'];
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
	
	// Get's characters by Region and BattleTag
	public function getCharacters($rg, $bt) {
		$url = $this->urlProfile[$rg] . strtolower(str_replace("#", "-", $bt)) . "/index";
		$data = $this->_getData($url);
		if(!isset($data['heroes'])) {
			return null;
		}
		foreach($data['heroes'] as $k => $v) {
			$data['heroes'][$k]['region'] = $rg;
		}
		return $data['heroes'];		
	}

	public function testURL($url) {
		return $this->_getData($url);
	}
}