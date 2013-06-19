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
		$query = array(
			'id' => (int) $id
		);
		$update = array(
			'$set' => array(),
			'$unset' => array(),
		);
		$data = Input::all();
		$valid_attrs = array_keys(D3Up_Attributes::$attributes['en']);
		$valid_stats = array('block-chance', 'block-amount', 'damage', 'speed', 'armor');
		if($attrs = Input::get('attrs')) {
			foreach($attrs as $k => $v) {
				if($v === "null" || $v === "0") {
					$update['$unset']['attrs.' . $k] = 1;
				} else {
					$update['$set']['attrs.' . $k] = (float) $v;				
				}				
			}			
		}
		if($stats = Input::get('stats')) {
			foreach($stats as $k => $v) {
				if($v === "null" || $v === "0") {
					$update['$unset']['stats.' . $k] = 1;
				} else {
					$update['$set']['stats.' . $k] = (float) $v;				
				}				
			}			
		}
		if(empty($update['$unset'])) {
			unset($update['$unset']);
		}
		if(empty($update['$set'])) {
			unset($update['$set']);
		}
		$collection = Epic_Mongo::db('item')->update($query, $update);
		var_dump($collection); 
		exit;
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