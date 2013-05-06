<?php
/**
 * undocumented class
 *
 * @package default
 * @author Aaron Cox
 **/
class D3Up_User extends Epic_Mongo_Document
{
	protected $_collection = 'users';
	// protected static $_documentType = 'user';
	
	// This should be embedded into something we extend?
	// public function findOne($query = array(), $fields = array()) {
	// 	$query['_type'] = static::$_documentType;
	// 	return parent::findOne($query, $fields);
	// }

	// This should be embedded into something we extend?
	// public function find($query = array(), $fields = array()) {
	// 	$query['_type'] = static::$_documentType;
	// 	return parent::find($query, $fields);
	// }
	
} // END class D3Up_User extends Epic_Mongo_Document