<?php

class Test_Controller extends Base_Controller {
	
	public $layout = 'template.main';
	
	public function action_itembuilder() {
		$item = Epic_Mongo::db('item')->findOne();
		$this->layout->nest('content', 'test.itembuilder', array(
			'item' => $item
		));
	}
	
}