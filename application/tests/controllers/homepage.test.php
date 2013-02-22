<?php
require_once('controller.php');

class HomepageControllerTest extends ControllerTestCase {

	public function testIndex() {
		// Make sure the homepage loads up and provides a 200 (OK) message
		$response = $this->get('home@index', array());
		$this->assertEquals('200', $response->foundation->getStatusCode());
	}

}