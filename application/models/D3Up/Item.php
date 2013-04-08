<?php
class D3Up_Item extends Epic_Mongo_Document_Sequenced {
	protected $_collection = 'items';
	protected $_typeMap = array(
		'_createdBy' => array('doc:user', 'ref'),
  );
	protected $_sequenceKey = 'item';
	protected $_tooltipData = array(
		'id',
		'name',
		'quality',
		'sockets',
		'stats',
		'type',
		'attrs',
		'icon',
	);
	
	public function tooltip() {
		// Data to Return for the Tooltip
		$data = array();
		// Use the keys specified on the object
		foreach($this->_tooltipData as $key) {
			if($this->$key) {
				if($this->$key instanceOf Epic_Mongo_Document) {
					$data[$key] = $this->$key->export();				
				} else {
					$data[$key] = $this->$key;									
				}
			}
		}
		return $data;
	}
	
	
	public function cleanedFor($type) {
		if($type == 'gearsetcache') {
			// If we're caching an item, 
			$this->_created = null;
			$this->_createdBy = null;
			$this->_id = null;
		}
		return $this;
	}
	
	public function save($whole = false) {
		throw new Exception("Saving is currently disabled.");
	}
	
}