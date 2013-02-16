<?php

class D3Up_Build extends Epic_Mongo_Document {
	
	protected $_collection = 'builds';
  protected $_typeMap = array(
		'gear' => array('ref:D3Up_Item', 'req'),
		'_createdBy' => array('doc:user', 'ref'),
  );

}