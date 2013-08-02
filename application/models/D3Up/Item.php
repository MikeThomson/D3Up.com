<?php
class D3Up_Item extends D3Up_Mongo_Document_Sequenced {
	protected $_collection = 'items';
	protected $_typeMap = array(
		'_createdBy' => array('doc:user', 'ref'),
  );
	protected $_sequenceKey = 'item';
	protected $_jsonData = array(
		'id' => null,
		'name' => null,
		'attrs' => null,
		'stats' => null,
		'icon' => null,
		'type' => null,
		'quality' => null,
		'sockets' => null,
		'_created' => 'created',
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
	
	public function save($whole = false, $modified = false) {
		// var_dump($this->export(), $modified); exit;
		// Did the user modify this item and wasn't modified before?
		if($modified && $this->_d3id) {
			// Remove the D3Id, It's invalid now
			$this->_d3id = null;
			// Store that the item was modified
			$this->_modified = true;
			// Save the Item
			$save = parent::save(true);
			// Now let's find the build(s) using this item to update caches
			Epic_Mongo::db('build')->modifiedItem((string) $this->_id);
			// Return the Save
			return $save;
		}
		// echo "done";
		// exit;
		return parent::save($whole);
	}

}