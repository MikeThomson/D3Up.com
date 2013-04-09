<?php

class Item_Controller extends Base_Controller {

	public $restful = true;
	
	public function get_view($id) {
		$item = Epic_Mongo::db('item')->findOne(array('id' => (int) $id));
		if(!$item) {
			return Response::error('404');
		}
		return View::make('item.view')->with('item', $item);
	}
}