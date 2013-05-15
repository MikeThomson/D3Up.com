<?php

class Item_Controller extends Base_Controller {

	public $restful = true;
	public $layout = 'template.main';
	
	public function get_view($id) {
		$item = Epic_Mongo::db('item')->findOne(array('id' => (int) $id));
		if(!$item) {
			return Response::error('404');
		}
		$this->layout->nest('content', 'item.view', array(
			'item' => $item,
		));
	}
}