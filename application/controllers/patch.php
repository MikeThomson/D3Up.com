<?php

class Patch_Controller extends Base_Controller {

	public function action_index()
	{
		return View::make('patch.index');
	}

}