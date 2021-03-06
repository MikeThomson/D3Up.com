<?php
class D3Up_Mongo_Iterator_Cursor extends Epic_Mongo_Iterator_Cursor {
  
	public function queryImplode($array, $glue) {
		$ret = '';
		foreach ($array as $key => $item) {
			if (is_array($item)) {
				$ret .= $this->queryImplode($item, $glue) . $glue;
			} else {
				$ret .= $key . $glue . serialize($item) . $glue;
			}
		}
		$ret = substr($ret, 0, 0-strlen($glue));
		return $ret;
	}
	
	public function count() {
		if(!class_exists('Cache')) {
			return parent::count();
		}
		$info = $this->_cursor->info();
		$hash = "cursor-cache-".md5($this->queryImplode($info['query'],"|"));
		if(Cache::has($hash)) {
			return Cache::get($hash);
		} else {
			$value = parent::count(true);
			Cache::put($hash, $value, 10);
			return $value;
		}
	}
	
	public function json() {
		$data = array();
		foreach($this as $doc) {
			$data[(string)$doc->_id] = $doc->json();
		}
		return $data;
	}
	
}