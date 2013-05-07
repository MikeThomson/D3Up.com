<?php

class D3Up_Build extends D3Up_Mongo_Document_Sequenced {
	
	protected $_collection = 'builds';
	protected $_sequenceKey = 'build';
	
  protected $_requirements = array(
		'gear' => array('doc:gearset', 'auto'),
		'_gear' => array('doc:gearsetcache', 'auto'),
		'_createdBy' => array('doc:user', 'ref'),
		'_original' => array('doc:build', 'ref'),
  );

	// These fields will be renamed/removed, null = remove, rename = string
	protected $_jsonData = array(
		'id'						=> null,
		'name'					=> null,
		'class'					=> 'heroClass',
		'gender'				=> null,
		'level'					=> null,
		'hardcore'			=> null,
		'paragon'				=> null,
		'actives'				=> null,
		'passives'			=> null,
		'_lastCrawl'		=> 'updated',
		'_characterId'	=> 'bt-id',
		'_characterBt'	=> 'bt-tag',
		'_characterRg'	=> 'bt-rg'
	);

	public function sync($type = null) {
		$tool = new D3Up_Sync();
		return $tool->run($this, $type);
	}
	
	public function getGear() {
		// If our cached gearset is a brand new document, skip over it
		if(!$this->_gear->isNewDocument()) {
			// If it's not a new document, return the cached version
			return $this->_gear;
		}
		// And use our normal gear
		return $this->gear;
	}
	
	public function json() {
		$data = parent::json();
		if(isset($this->stats['dps'])) {
			$data['dps'] = round($this->stats['dps'], 2);
		}
		if(isset($this->stats['ehp'])) {
			$data['ehp'] = round($this->stats['ehp'], 2);
		}
		return $data;
	}

}