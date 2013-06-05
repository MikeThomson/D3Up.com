<?php

class Bug_Controller extends Base_Controller {

	public $restful = true;
	public $layout = 'template.main';
	
	public function get_thanks() {
		$this->layout->nest('content', 'bug.thanks', array('build' => Input::get('build')));
	}
	
	public function post_report() {
		$bug = Epic_Mongo::db('doc:bug');
		$query = array(
			'id' => (int) Input::get('build')
		);
		$build = Epic_Mongo::db('build')->findOne($query);
		$bug->build = $build;
		$bug->description = Input::get('description');
		$bug->stats = json_decode(Input::get('stats'), true);
		$bug->save();
		return Redirect::to('/bug/thanks?build='.$build->id);
	}
}