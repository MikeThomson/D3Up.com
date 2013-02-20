<?php

class D3Up_Build extends Epic_Mongo_Document {
	
	protected $_collection = 'builds';
  protected $_typeMap = array(
		'gear' => array('doc:gearset', 'auto'),
		'_createdBy' => array('doc:user', 'ref'),
  );

}