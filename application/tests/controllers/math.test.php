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
			// 'title' => 'Sample Title to avoid Title Validation Failure', // Commented out Title to generate the error
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
			// 'content' => 'Sample Content to avoid Content Validation Failure', // Commented out Content to generate the error
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
			// 'locale' => 'en', // Commented out Locale to generate the error
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
	public function testIndex() {
		// Load math@index
		$response = $this->get('math@index');
		// Assert that the HTTP Status Code is 200 (OK)
		$this->assertEquals('200', $response->foundation->getStatusCode());
		// Assert that the View has a cursor
		$this->assertInstanceOf('Epic_Mongo_Iterator_Cursor', $response->content->data['math']);
		// Assert that it has data in it
		$this->assertGreaterThan(0, $response->content->data['math']->count());
	}
	
	/**
   * @depends testEdit
   */
	public function testView() {
		$sample = $this->getTestDocument();
		// Load math@view with sample math
		$response = $this->get('math@view', array('id' => $sample->id));
		// Assert that the HTTP Status Code is 200 (OK)
		$this->assertEquals('200', $response->foundation->getStatusCode());
		// Assert that the View has a real math document
		$this->assertInstanceOf('D3Up_Math', $response->content->data['math']);
	}

	/**
   * @depends testView
   */
	public function testDelete() {
		$sample = $this->getTestDocument();
		// Load math@delete with sample math
		$response = $this->get('math@delete', array('id' => $sample->id));
		// Assert that the HTTP Status Code is 200 (OK)
		$this->assertEquals('200', $response->foundation->getStatusCode());
		// Now send the request to delete the sample math
		$this->post('math@delete', array('id' => $sample->id, 'confirm' => true));
		// Request the view page for the math, and ensure it doesn't exist
		$response = $this->get('math@view', array('id' => $sample->id));
		// Assert that the HTTP Status Code is 302 (Redirect)
		$this->assertEquals('302', $response->foundation->getStatusCode());
	}
	
	public function __destruct() {
		// Find and remove any math entry that has the test flag
		$query = array('_unitTest' => true);
		// Get the Database
		$db = Epic_Mongo::db('math')->getSchema()->getMongoDb();
		// Remove all the results
		$result = $db->math->remove($query);
	}
}