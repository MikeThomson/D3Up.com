<?php
class DBCheck_Task {
		
	public function run($args) {
		Request::set_env('development');
		Bundle::start('epic_mongo');
		Epic_Mongo::db()->ensureIndexes();
	}
	
}