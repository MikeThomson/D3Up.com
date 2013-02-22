<?php
require_once('model.php');

class BuildModelTest extends ModelTestCase {

	public function testFindOne() {
		$build = Epic_Mongo::db('build')->findOne();
		$this->assertInstanceOf('D3Up_Build', $build);
	}

}