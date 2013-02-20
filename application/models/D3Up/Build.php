<?php

class D3Up_Build extends Epic_Mongo_Document {
	
	protected $_collection = 'builds';
  protected $_typeMap = array(
		'gear' => array('set:item', 'auto'),
		// 'set:gear' => 'Test_DocumentSet_DocumentSet',
		// 	
		// 'gear' => array('set', 'auto'),
		// 'gear.$' => array('ref:D3Up_Items', 'req'),	
		'_createdBy' => array('doc:user', 'ref'),
  );

}