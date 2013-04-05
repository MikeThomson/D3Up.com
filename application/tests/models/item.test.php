<?php
require_once('model.php');

class ItemModelTest extends ModelTestCase {

	protected $_item = null; // Storage for Test Build
	public function __construct() {
		// Find an item with an owner
		$query = array(
			'_createdBy' => array(
				'$exists' => true
			)
		);
		// Load up an Item for testing purposes
		$this->_item = Epic_Mongo::db('item')->findOne($query);
	}

	public function testFind() {
		// Ensure the Builds collection returns a cursor on find.
		$build = Epic_Mongo::db('item')->find();
		$this->assertInstanceOf('Epic_Mongo_Iterator_Cursor', $build);
	}

	public function testFindOne() {
		// Ensure that a build comes back as the proper object
		$this->assertInstanceOf('D3Up_Item', $this->_item);
	}
	
	public function testItemOwner() {
		// Ensure the reference to the build's owner is properly resolving
		$this->assertInstanceOf('D3Up_User', $this->_item->_createdBy);
	}

}