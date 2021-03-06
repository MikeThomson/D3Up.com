<?php

class Test_Controller extends Base_Controller {
	
	public $layout = 'template.main';
	
	public function action_itembuilder() {
		$item1 = Epic_Mongo::db('item')->findOne(array('id' => 21));
		$item2 = Epic_Mongo::db('item')->findOne(array('id' => 27));
		$item3 = Epic_Mongo::db('item')->findOne(array('type' => 'sword'));
		$this->layout->nest('content', 'test.itembuilder', array(
			'item1' => $item1,
			'item2' => $item2,
			'item3' => $item3
		));
	}
	
	public function action_client() {
		$this->layout->nest('content', 'test.client');
		$this->layout = null;
		return View::make('test.client');
	}

	public function action_client_window() {
		$build = Epic_Mongo::db('build')->findOne();
		$this->layout = null;
		return View::make('test.client_window');
	}
	
}