<?php
require_once('model.php');

class BuildModelTest extends ModelTestCase {

	protected $_build = null; // Storage for Test Build
	public function __construct() {
		// Load up Build #1 for testing purposes
		$this->_build = Epic_Mongo::db('build')->findOne(array('id' => 1));
	}

	public function testFind() {
		// Ensure the Builds collection returns a cursor on find.
		$build = Epic_Mongo::db('build')->find();
		$this->assertInstanceOf('Epic_Mongo_Iterator_Cursor', $build);
	}

	public function testFindOne() {
		// Ensure that a build comes back as the proper object
		$this->assertInstanceOf('D3Up_Build', $this->_build);
	}
	
	public function testBuildGear() {
		// Ensure the reference to gearsets is properly resolving
		$this->assertInstanceOf('D3Up_GearSet', $this->_build->gear);
	}

	public function testBuildOwner() {
		// Ensure the reference to the build's owner is properly resolving
		$this->assertInstanceOf('D3Up_User', $this->_build->_createdBy);
	}

}