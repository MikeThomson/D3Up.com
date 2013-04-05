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

	public function testIndex() {
		// Load build@index
		$response = $this->get('build@index');
		// Assert that the HTTP Status Code is 200 (OK)
		$this->assertEquals('200', $response->foundation->getStatusCode());
		// Assert that the View has a cursor
		$this->assertInstanceOf('Epic_Mongo_Iterator_Cursor', $response->content->data['builds']);
		// Store the Builds from the Response
		$builds = $response->content->data['builds'];
		// Assert that the View has a non-empty cursor
		$this->assertNotEquals(0, count($builds));
		// Rewind the Cursor to the beginning
		$builds->rewind();
		// Assert that the View has builds in it
		$this->assertInstanceOf('D3Up_Build', $builds->current());
	}
	
	public function testIndexFilters() {
		// Class we are going to filter on
		$class = 'monk';
		// Load build@index with the class filter
		$response = $this->get('build@index', array(), array('class' => $class));
		// Assert that the HTTP Status Code is 200 (OK)
		$this->assertEquals('200', $response->foundation->getStatusCode());
		// Assert that the View has a cursor
		$this->assertInstanceOf('Epic_Mongo_Iterator_Cursor', $response->content->data['builds']);
		// Store the Builds from the Response
		$builds = $response->content->data['builds'];
		// Assert that the View has a non-empty cursor
		$this->assertNotEquals(0, count($builds));
		// Rewind the Cursor to the beginning
		$builds->rewind();
		// Get a Single Build
		$build = $builds->current();
		// Assert that the View has builds in it
		$this->assertInstanceOf('D3Up_Build', $build);
		// Assert that the build is the right class
		$this->assertEquals($class, $build->class);
	}
	
	public function testIndexSorting() {
		// Load build@index and add sorting parameter
		$response = $this->get('build@index', array(), array('sort' => 'dps'));
		// Assert that the HTTP Status Code is 200 (OK)
		$this->assertEquals('200', $response->foundation->getStatusCode());
		// Assert that the View has a cursor
		$this->assertInstanceOf('Epic_Mongo_Iterator_Cursor', $response->content->data['builds']);
		// Store the Builds from the Response
		$builds = $response->content->data['builds'];
		// Assert that the View has a non-empty cursor
		$this->assertNotEquals(0, count($builds));
		// Rewind the Cursor to the beginning
		$builds->rewind();
		// Get Build #1
		$build1 = $builds->current();
		// Advance the Cursor by one
		$builds->next();
		// Get Build #2
		$build2 = $builds->current();
		// Assert that the builds are actually builds
		$this->assertInstanceOf('D3Up_Build', $build1);
		$this->assertInstanceOf('D3Up_Build', $build2);
		// Assert that Build 1 has a higher DPS than Build 2
		$this->assertGreaterThan((int)$build2->stats['dps'], (int)$build1->stats['dps']);
	}
	
	public function testCompare() {
		// Load build@compare with build #1 and build #2
		$response = $this->get('build@compare', array('id1' => 1, 'id2' => 2));
		// Assert that the HTTP Status Code is 200 (OK)
		$this->assertEquals('200', $response->foundation->getStatusCode());
		// Assert that the View has a cursor
		$this->assertInstanceOf('D3Up_Build', $response->content->data['build1']);
		$this->assertInstanceOf('D3Up_Build', $response->content->data['build2']);
	}
}