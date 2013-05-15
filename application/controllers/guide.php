<?php

class Guide_Controller extends Base_Controller {
	public $restful = true;
	public $layout = 'template.main';
	
	public function get_index() {
		$query = array(
			'published' => true,
		);
		$guides = Epic_Mongo::db('guide')->find($query);
		$this->layout->nest('content', 'guide.index', array(
			'guides' => $guides
		));
	}
	
	public function get_view($id) {
		$guide = Epic_Mongo::db('guide')->findOne(array("id" => (int) $id));
		$this->layout->nest('content', 'guide.view', array(
			'guide' => $guide
		));
	}
	
}