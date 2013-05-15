<?php

class Patch_Controller extends Base_Controller {

	public $layout = 'template.main';

	public function action_index()
	{
		$this->layout->nest('content', 'patch.index');
	}

}