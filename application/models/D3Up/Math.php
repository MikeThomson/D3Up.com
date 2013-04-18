<?php
class D3Up_Math extends D3Up_Mongo_Document_Sequenced {
	
	protected $_collection = 'math';
	protected $_sequenceKey = 'math';
	
  protected $_requirements = array(
		'_localized' => array('doc:localized'),
  );

	public function saveRevision($lang) {
		$doc = Epic_Mongo::db('doc:math_revision');
		$doc->lang = $lang;
		$doc->original = $this;
		$doc->_localized = $this->_localized;
		$doc->_originalId = $this->id;
		$doc->_timestamp = time();
		$doc->save();
	}
	
	public function save($entire = false) {
		if(Request::cli()) {
			$this->_unitTest = true;
		}
		return parent::save($entire);
	}
}