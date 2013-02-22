<?php
require_once('controller.php');

class BuildControllerTest extends ControllerTestCase {

	public function testView() {
		$response = $this->get('build@view', array('id' => 1));
		$this->assertEquals('200', $response->foundation->getStatusCode());
	}

}