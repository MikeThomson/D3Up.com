<?php

class D3Up_Build extends Epic_Mongo_Document {
	
	protected $_collection = 'builds';
  protected $_typeMap = array(
		'gear' => array('doc:gearset', 'auto'),
		'_createdBy' => array('doc:user', 'ref'),
  );

	// These fields will be renamed/removed, null = remove, rename = string
	protected $_fieldMod = array(
		// Internal Flags / Timestamps
		'_id' => null, 
		'_created' => null, 
		'_lastCrawl' => null,
		'crawlCount' => null,
		'_type' => null,
		'private' => null,
		'_createdBy' => null,
		'views' => null,
		// Twitch Information
		'_twitchEnabled' => null,
		'_twitchLastCheck' => null,
		'_twitchOnline' => null,
		// Character BattleNet Info
		'_characterBt' => 'battletag',
		'_characterId' => null,
		'_characterRg' => null,
		// Old Description Fields
		'description' => null,
		'descriptionSource' => null,
		'_defaultToDescription' => null, 
		// The characters gear/stats, we don't need it here
		'gear' => null,
		'equipment' => null,
		'equipmentCount' => null,
		'stats' => null,
		// Since JS reserves class, we use heroClass in JS
		'class' => 'heroClass',
	);

	public function sync() {
		$tool = new D3Up_Sync();
		return $tool->run($this);
	}
	
	public function json() {
		$data = $this->export();
		foreach($this->_fieldMod as $field => $mod) {
			if($mod) {
				$data[$mod] = $data[$field];
			}
			unset($data[$field]);				
		}
		return json_encode($data);
	}
}