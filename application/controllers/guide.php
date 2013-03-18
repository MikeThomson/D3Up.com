<?php

class Guide_Controller extends Base_Controller {
	public $restful = true;
	
	public function get_index() {
		$query = array(
			'published' => true,
		);
		$guides = Epic_Mongo::db('guide')->find($query);
		return View::make('guide.index')->with('guides', $guides);
	}
	
	public function get_view($id) {
		$guide = Epic_Mongo::db('guide')->findOne(array("id" => (int) $id));
		return View::make('guide.view')->with('guide', $guide);		
	}
	
}