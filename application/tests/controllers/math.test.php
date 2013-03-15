<?php
require_once('controller.php');

class MathControllerTest extends ControllerTestCase {
	public function getTestDocument() {
		return Epic_Mongo::db('math')->findOne(array("_unitTest" => true));
	}

	public function testValidationTitle() {
		// Load build@create from the controller
		$response = $this->get('math@create');
		// Simulated Form Data
		$data = array(
			'explanation' => 'Automatically generated record by PHPUnit (Testing Title Validity)',
			'content' => 'Sample Content to avoid Content Validation Failure',
			'locale' => 'en',
		);
		// Post the Data to the Form
		$response = $this->post('math@create', $data);
		// See if it got inserted
		$this->assertNull(Epic_Mongo::db('math')->findOne($data));
	}
	public function testValidationContent() {
		// Load build@create from the controller
		$response = $this->get('math@create');
		// Simulated Form Data
		$data = array(
			'title' => 'Sample Title to avoid Title Validation Failure',
			'explanation' => 'Automatically generated record by PHPUnit (Testing Content Validity)',
			'locale' => 'en',
		);
		// Post the Data to the Form
		$response = $this->post('math@create', $data);
		// See if it got inserted
		$this->assertNull(Epic_Mongo::db('math')->findOne($data));
	}
	public function testValidationLocale() {
		// Load build@create from the controller
		$response = $this->get('math@create');
		// Simulated Form Data
		$data = array(
			'title' => 'Sample Title to avoid Title Validation Failure',
			'explanation' => 'Automatically generated record by PHPUnit (Testing Locale Validity)',
			'content' => 'Sample Content to avoid Content Validation Failure',
		);
		// Post the Data to the Form
		$response = $this->post('math@create', $data);
		// See if it got inserted
		$this->assertNull(Epic_Mongo::db('math')->findOne($data));
	}
	
	public function testCreate() {
		// Load build@create from the controller
		$response = $this->get('math@create');
		// Assert that the HTTP Status Code is 200 (OK)
		$this->assertEquals('200', $response->foundation->getStatusCode());
		// Simulated Form Data
		$data = array(
			'title' => 'Unit Test',
			'explanation' => 'Automatically generated record by PHPUnit',
			'locale' => 'en',
			'content' => 'Some Markdown, We\'ll make sure it gets turned into HTML by checking for this **strong text**.',
		);
		// Post the Data to the Form
		$response = $this->post('math@create', $data);
	}
	
	public function testEditAddLanguage() {
		
	}
	
	/**
   * @depends testCreate
   */
	public function testEdit() {
		$sample = $this->getTestDocument();
		// Check to make sure it doesn't have the Pig Latin language (it's new)
		$this->assertArrayNotHasKey('pl', $sample->_localized->export());
		// Load build@create from the controller
		$response = $this->get('math@edit', array("id" => $sample->id));
		// Assert that the HTTP Status Code is 200 (OK)
		$this->assertEquals('200', $response->foundation->getStatusCode());
		// Simulated Form Data
		$data = array(
			'id' => $sample->id,
			'title' => 'Unit Test in Pig Latin',
			'explanation' => 'Automatically generated record by PHPUnit',
			'locale' => 'pl',
			'content' => 'Some Markdown, We\'ll make sure it gets turned into HTML by checking for this **strong text**.',
		);
		// Post the Data to the Form
		$response = $this->post('math@edit', $data);
		// Assert that the HTTP Status Code is 302 (Redirected to the edit page)
		$this->assertEquals('302', $response->foundation->getStatusCode());
		// var_dump($response); exit;
		// Reload the Sample Document
		$sample = $this->getTestDocument();
		// Assert that it does now have the Pig Latin entry
		$this->assertArrayHasKey('pl', $sample->_localized->export());
	}

	/**
   * @depends testEdit
   */
	public function testView() {
		$sample = $this->getTestDocument();
		// Load build@view with build #1
		$response = $this->get('math@view', array('id' => $sample->id));
		// Assert that the HTTP Status Code is 200 (OK)
		$this->assertEquals('200', $response->foundation->getStatusCode());
		// Assert that the View has a real math document
		$this->assertInstanceOf('D3Up_Math', $response->content->data['math']);
	}

	public function testDelete() {
		
	}
	
	/**
   * @depends testView
   */
	public function testCleanup() {
		// Find and remove any math entry that has the test flag
		$query = array('_unitTest' => true);
		// Get the Database
		$db = Epic_Mongo::db('math')->getSchema()->getMongoDb();
		// Remove all the results
		$result = $db->math->remove($query);
		// Query again
		$results = Epic_Mongo::db('math')->find($query);
		// Ensure they're gone!
		$this->assertEquals(0, $results->count());
	}
}