<?php
/**
 * undocumented class
 *
 * @package default
 * @author Aaron Cox
 **/
abstract class D3Up_TestCase extends PHPUnit_Framework_TestCase
{
	public function __construct() {
		Bundle::start('epic_mongo');
	}
	
	public function setUp() {
		// --------------------------------------------------------------
		// Create Test Information
		// --------------------------------------------------------------
		if(!$build1 = Epic_Mongo::db('build')->findOne(array('id' => 1))) {
			$build1 = Epic_Mongo::db('doc:build');
		}
		if(!$build2 = Epic_Mongo::db('build')->findOne(array('id' => 2))) {
			$build2 = Epic_Mongo::db('doc:build');
		}
		if(!$user = Epic_Mongo::db('user')->findOne(array('id' => 1))) {
			$user = Epic_Mongo::db('doc:user');
		}
		if(!$item = Epic_Mongo::db('item')->findOne(array('id' => 1))) {
			$item = Epic_Mongo::db('doc:item');
		}
		// Define the User
		$user->id = 1;
		$user->username = 'Test User';
		$user->save();
		// Define the Item
		$item->id = 1;
		$item->name = 'Test Item';
		$item->_createdBy = $user;
		$item->save();
		// Create a Gearset
		$gearset = Epic_Mongo::db('doc:gearset');
		// Add $item to Gearset
		$gearset->helm = $item;
		// Define Build #1
		$build1->id = 1;
		$build1->name = 'Test Build #1';
		$build1->class = 'monk';
		$build1->_characterBt = 'jesta#1121'; 
		$build1->_characterId = '1963090';
		$build1->_characterRg = '1';
		$build1->_createdBy = $user;
		$build1->gear = $gearset;
		$build1->stats = array('dps' => 1);
		$build1->save();
		// Define Build #2
		$build2->id = 2;
		$build2->name = 'Test Build #2';
		$build2->class = 'barbarian';
		$build2->_characterBt = 'jesta#1121'; 
		$build2->_characterId = '1963090';
		$build2->_characterRg = '1';
		$build2->_createdBy = $user;
		$build2->gear = $gearset;
		$build2->stats = array('dps' => 2);
		$build2->save();
	}

	public function __destruct() {
		$db = Epic_Mongo::db('build')->getSchema()->getMongoDb();
		$db->execute('db.dropDatabase()');
	}
} // END class D3Up_TestCase