<?php

class D3Up_Ladder extends D3Up_Mongo_Document_Sequenced {
	
	protected $_collection = 'ladders';
	protected $_sequenceKey = 'ladder';
	
  protected $_requirements = array(
		'builds' => array('set:roster', 'auto'),
  );

}