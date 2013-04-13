<?php
class DBCheck_Task {
		
	public function run($args) {
		Bundle::start('epic_mongo');
		Epic_Mongo::db()->ensureIndexes();
	}
	
}