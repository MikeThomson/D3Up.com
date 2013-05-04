<?php
class D3Up_Mongo_Document_Sequenced extends Epic_Mongo_Document_Sequenced {
	protected $_sequenceCollection = 'sequences';
	
	public function findOne($query = array(), $fields = array()) {
		$time = -microtime(true);
		$results = parent::findOne($query, $fields);
		if(class_exists('Config') && Config::get('application.profiler') && $results) {
			$time += microtime(true);
			Profiler::query("db.".$results->getCollection().".findOne(" . json_encode($query) .")", array(), round($time, 4));
		}		
		return $results;
	}
	
	public function find($query = array(), $fields = array()) {
		$results = parent::find($query, $fields);
		if(class_exists('Config') && Config::get('application.profiler')) {
			$explain = $results->getInnerIterator()->explain();
			Profiler::query("db.".$results->getCollection().".find(" . json_encode($query) .")", array(), $explain['millis']);
		}		
		return $results;
	}
	
	public function json() {
		$data = array();
		foreach($this->_jsonData as $idx => $rename) {
			// Hacky... I know... needs to be removed and done better
			if($idx == "gender") {
				if(!$this->$idx) {
					$data['gender'] = "male";					
				} else {
					if($this->gender === 0) {
						$data['gender'] = "male";					
					} else {
						$data['gender'] = "female";											
					}
				}
			}
			
			if($this->$idx) {
				if($rename) {
					if($this->$idx instanceOf Epic_Mongo_Document) {
						$data[$rename] = $this->$idx->export();																								
					} else {
						$data[$rename] = $this->$idx;																		
					}
				} else {
					if($this->$idx instanceOf Epic_Mongo_Document) {
						$data[$idx] = $this->$idx->export();																								
					} else {
						$data[$idx] = $this->$idx;						
					}
				}
			}
		}
		return $data;		
	}
} // END class Epic_Mongo_Document_Sequenced