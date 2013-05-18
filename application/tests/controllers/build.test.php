<?php
require_once('controller.php');

class BuildControllerTest extends ControllerTestCase {

	public function testView() {
		// Load build@view with build #1
		$response = $this->get('build@view', array('id' => 1));
		// Assert that the HTTP Status Code is 200 (OK)
		$this->assertEquals('200', $response->foundation->getStatusCode());
		// Assert that the View has a real build
		$this->assertInstanceOf('D3Up_Build', $response->content->data['content']['build']);
	}

	public function testCompare() {
		// Load build@compare with build #1 and build #2
		$response = $this->get('build@compare', array('id1' => 1, 'id2' => 2));
		// Assert that the HTTP Status Code is 200 (OK)
		$this->assertEquals('200', $response->foundation->getStatusCode());
		// Assert that the View has a cursor
		$this->assertInstanceOf('D3Up_Build', $response->content->data['content']['build1']);
		$this->assertInstanceOf('D3Up_Build', $response->content->data['content']['build2']);
	}
}