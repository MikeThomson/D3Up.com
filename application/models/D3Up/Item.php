<?php
class D3Up_Item extends D3Up_Mongo_Document_Sequenced {
	protected $_collection = 'items';
	protected $_typeMap = array(
		'_createdBy' => array('doc:user', 'ref'),
  );
	protected $_sequenceKey = 'item';
	protected $_jsonData = array(
		'id'						=> null,
		'name'					=> null,
		'attrs'					=> null,
		'stats'					=> null,
		'type'					=> null,
		'quality'				=> null,
		'_created'			=> 'created',
	);
	
	public function cleanedFor($type) {
		if($type == 'gearsetcache') {
			// If we're caching an item, 
			$this->_created = null;
			$this->_createdBy = null;
			$this->_id = null;
		}
		return $this;
	}

}