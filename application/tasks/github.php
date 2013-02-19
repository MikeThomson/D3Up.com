<?php
class Github_Task {
	
	protected $_rss = 'https://github.com/aaroncox/D3Up.com/commits/master.atom?login=aaroncox';
	protected $_limit = 5;
	
	public function run($args) {
		$token = Config::get('github.token');
		$content = file_get_contents($this->_rss."&token=".$token);  
		$rss = new SimpleXmlElement($content);
		$data = array();
		$idx = 1;
		foreach($rss as $entry) {
			if($entry->updated && $entry->title && $idx <= $this->_limit) {
				$data[(string)$entry->updated] = (string)$entry->title;
				$idx++;
			}
		}
		Cache::put('github_commits', $data, 120);
	}
	
}