<?php

class D3Up_Build extends D3Up_Mongo_Document_Sequenced {
	
	protected $_collection = 'builds';
	protected $_sequenceKey = 'build';
	
  protected $_requirements = array(
		'gear' => array('doc:gearset', 'auto'),
		'ladder' => array('doc:ladder', 'ref'),
		'_gear' => array('doc:gearsetcache', 'auto'),
		'_createdBy' => array('doc:user', 'ref'),
		'_original' => array('doc:build', 'ref'),
  );

	// These fields will be renamed/removed, null = remove, rename = string
	protected $_jsonData = array(
		'id'						=> null,
		'name'					=> null,
		'class'					=> null,
		'gender'				=> null,
		'level'					=> null,
		'hardcore'			=> null,
		'paragon'				=> null,
		'actives'				=> null,
		'passives'			=> null,
		'_lastCrawl'		=> 'updated',
		'_characterId'	=> 'bt-id',
		'_characterBt'	=> 'bt-tag',
		'_characterRg'	=> 'bt-rg',
		'_authentic' 		=> 'authentic'
	);

	public function sync($type = null, $bypass = false) {
		$tool = new D3Up_Sync();
		return $tool->run($this, $type, $bypass);
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
	
	public function json($gear = false) {
		$data = parent::json();
		if(isset($this->stats['dps']) && isset($this->stats['dps']['dps'])) {
			$data['dps'] = round($this->stats['dps']['dps'], 2);
		}
		if(isset($this->stats['ehp']) && isset($this->stats['ehp']['ehp'])) {
			$data['ehp'] = round($this->stats['ehp']['ehp'], 2);
		}
		if($gear) {
			$data['gear'] = $this->_gear->export();
		}
		return $data;
	}
	
	public function modifiedItem($id) {
		$query = array(
			'_createdBy' => Auth::user()->createReference(),
			'_gearIds' => $id,
		);
		$builds = Epic_Mongo::db('build')->find($query);
		foreach($builds as $build) {
			$build->_authentic = false;
			$build->save(true, true);
		}
	}
	
	public function save($whole = false, $recache = false) {
		if($recache === true) {
			$this->_gear = Epic_Mongo::db('doc:gearsetcache');
			$gearIds = array();
			foreach($this->gear as $slot => $item) {
				$item = $this->gear[$slot]->export();
				$this->_gear[$slot] = $item;
				$gearIds[] = (string) $item['_id'];				
			}
			$this->_gearIds = $gearIds;			
		} 
		return parent::save($whole); 
	}

}