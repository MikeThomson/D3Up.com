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
	
	public function post_edit($id) {
		$item = Epic_Mongo::db('item')->findOne(array('id' => (int) $id));
		if(!$item) {
			return Response::error('404');
		}
		$valid_attrs = array_keys(D3Up_Attributes::$attributes['en']);
		foreach(Input::only($valid_attrs) as $key => $value) {
			if($value === "null") {
				unset($item->attrs[$key]);
			} else {
				$item->attrs[$key] = $value;				
			}
		}
		$valid_stats = array('block-chance', 'block-amount', 'damage', 'speed', 'armor');
		foreach(Input::only($valid_stats) as $key => $value) {
			if(is_array($value)) {
				foreach($value as $skey => $svalue) {
					$item->stats[$key][$skey] = $svalue;
				}
			} else {
				$item->stats[$key] = $value;									
			}
		}
		$item->save();
	}
	
	public function get_edit($id) {
		$item = Epic_Mongo::db('item')->findOne(array('id' => (int) $id));
		if(!$item) {
			return Response::error('404');
		}
		$this->layout->nest('content', 'item.edit', array(
			'item' => $item,
		));		
	}
}