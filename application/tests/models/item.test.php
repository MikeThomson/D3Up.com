<?php
require_once('model.php');

class ItemModelTest extends ModelTestCase {

	protected $_item = null; // Storage for Test Build
	public function setUp() {
		// Find an item with an owner
		$query = array(
			'_createdBy' => array(
				'$exists' => true
			)
		);
		// Load up an Item for testing purposes
		$this->_item = Epic_Mongo::db('item')->findOne($query);
		// var_dump($this->_item->id);
	}

	public function testFind() {
		// Ensure the Builds collection returns a cursor on find.
		$items = Epic_Mongo::db('item')->find();
		$this->assertInstanceOf('Epic_Mongo_Iterator_Cursor', $items);
	}

	public function testFindOne() {
		// Ensure that a build comes back as the proper object
		// var_dump($this->_item->id);
		$this->assertInstanceOf('D3Up_Item', $this->_item);
	}
	
	public function testItemOwner() {
		// Ensure the reference to the build's owner is properly resolving
		$this->assertInstanceOf('D3Up_User', $this->_item->_createdBy);
	}

}