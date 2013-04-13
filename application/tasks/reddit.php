<?php
class Reddit_Task {
	
	protected $_maxStories = 5;
		
	public function run($args) {
		$str = file_get_contents('http://www.reddit.com/r/d3up.json');
		$activity = array();
		if($str) {
			$json = json_decode($str, true);
			if(isset($json['data']) && isset($json['data']['children'])) {
				foreach($json['data']['children'] as $post) {
					if(count($activity) >= $this->_maxStories) {
						continue;
					}
					$activity[$post['data']['id']] = array(
						'title' => $post['data']['title'],
						'score' => $post['data']['score'],
						'url' => $post['data']['url'],
						'created' => $post['data']['created'],
						'author' => $post['data']['author'],
					);
				}
			}
		}
		Cache::put('reddit-activity', $activity, 120);
	}
	
}