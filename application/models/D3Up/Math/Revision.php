<?php
/**
 * undocumented class
 *
 * @package default
 * @author Aaron Cox
 **/
class D3Up_Math_Revision extends D3Up_Mongo_Document_Sequenced {
	protected $_collection = 'math_revision';
	protected $_sequenceKey = 'math_revision';
	
	protected $_requirements = array(
		'_localized' => array('doc:localized'),
		'original' => array('doc:math', 'ref'),
	);
	
}
