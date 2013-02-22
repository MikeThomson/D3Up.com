<?php

class Build_Controller extends Base_Controller {

	public function action_view($id, $data = false)
	{
		$build = Epic_Mongo::db('build')->findOne(array('id' => (int) $id));
		if(!$build) {
			return Response::error('404');
		}
		return View::make('build.view')->with('build', $build);
	}

}