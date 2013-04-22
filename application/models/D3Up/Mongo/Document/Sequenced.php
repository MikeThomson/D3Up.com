<?php
class D3Up_Mongo_Document_Sequenced extends Epic_Mongo_Document_Sequenced {
	protected $_sequenceCollection = 'sequences';
	
	public function findOne($query = array(), $fields = array()) {
		$time = -microtime(true);
		$results = parent::findOne($query, $fields);
		if(Config::get('application.profiler') && $results) {
			$time += microtime(true);
			Profiler::query("db.".$results->getCollection().".find(" . json_encode($query) .")", array(), round($time, 4));
		}		
		return $results;
	}
	
	public function find($query = array(), $fields = array()) {
		$results = parent::find($query, $fields);
		if(Config::get('application.profiler')) {
			$explain = $results->getInnerIterator()->explain();
			Profiler::query("db.".$results->getCollection().".find(" . json_encode($query) .")", array(), $explain['millis']);
		}		
		return $results;
	}
} // END class Epic_Mongo_Document_Sequenced