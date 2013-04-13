<?php
class D3Up_Math extends D3Up_Mongo_Document_Sequenced {
	
	protected $_collection = 'math';
	protected $_sequenceKey = 'math';
	
  protected $_requirements = array(
		'_localized' => array('doc:localized'),
  );
	
	public function save($entire = false) {
		if(Request::cli()) {
			$this->_unitTest = true;
		}
		return parent::save($entire);
	}
}