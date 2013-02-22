<?php
require_once('controller.php');

class BuildControllerTest extends ControllerTestCase {

	public function testView() {
		// Load build@view with build #1
		$response = $this->get('build@view', array('id' => 1));
		// Assert that the HTTP Status Code is 200 (OK)
		$this->assertEquals('200', $response->foundation->getStatusCode());
		// Assert that the View has a real build
		$this->assertInstanceOf('D3Up_Build', $response->content->data['build']);
	}

}