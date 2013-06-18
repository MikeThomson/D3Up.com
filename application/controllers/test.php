<?php

class Test_Controller extends Base_Controller {
	
	public $layout = 'template.main';
	
	public function action_itembuilder() {
		$item = Epic_Mongo::db('item')->findOne();
		$this->layout->nest('content', 'test.itembuilder', array(
			'item' => $item
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