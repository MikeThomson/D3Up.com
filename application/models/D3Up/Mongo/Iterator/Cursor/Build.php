<?php
class D3Up_Mongo_Iterator_Cursor_Build extends D3Up_Mongo_Iterator_Cursor {
	public function json() {
		return array_map(function($doc) {
			$fields = array(
				'id'						=> null,
				'name'					=> null,
				'class'					=> null,
				'level'					=> null,
				'hardcore'			=> null,
				'paragon'				=> null,
				'actives'				=> null,
				'passives'			=> null,
				'_characterId'	=> 'bt-id',
				'_characterBt'	=> 'bt-tag',
				'_characterRg'	=> 'bt-srv'
			);
			$data = array();
			foreach($fields as $idx => $rename) {
				if(isset($doc[$idx])) {
					if($rename) {
						$data[$rename] = $doc[$idx];												
					} else {
						$data[$idx] = $doc[$idx];						
					}
				}
				if(isset($doc['_gear'])) {
					$data['gear'] = array();
					foreach($doc['_gear'] as $slot => $item) {
						$data['gear'][$slot] = $item['id'];
					}
				}
				if(isset($doc['stats'])) {
					if(isset($doc['stats']['dps'])) {
						$data['dps'] = round($doc['stats']['dps'], 2);
					}
					if(isset($doc['stats']['ehp'])) {
						$data['ehp'] = round($doc['stats']['ehp'], 2);						
					}
				}
			}
			return $data;
		}, $this->export());
	}
}