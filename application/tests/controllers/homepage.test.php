<?php
require_once('controller.php');

class HomepageControllerTest extends ControllerTestCase {

	public function testIndex() {
		$response = $this->get('home@index', array());
		$this->assertEquals('200', $response->foundation->getStatusCode());
	}

}