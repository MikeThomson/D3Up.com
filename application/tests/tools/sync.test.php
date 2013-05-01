<?php
require_once(path('app')."tests/tool.php");
class SyncToolTest extends ToolTestCase {

	protected $_build = null; // Storage for Test Build
	protected $_syncResults = null; // Storage for the Sync Results array.
	
	public function setUp() {
		parent::setUp();
		Bundle::start("binder");
		$this->_build = Epic_Mongo::db('build')->findOne(array('id' => 1));
		$this->_syncResults = $this->_build->sync();
	}
	
	public function testSyncNotFatal() {
		// We should NOT get a fatal error by sync'ing this build.
		$this->assertNull($this->_syncResults['fatal']);
	}

}