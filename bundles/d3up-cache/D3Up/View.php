<?php namespace D3Up;

use Laravel\Session;
use SimpleMessage\Messaging\Typed\Messages as TypedMessages;

class View extends \Laravel\View {

	public static function cached($template, $data) {
		$doc_type = implode(array_keys($data));
		$doc_id = $data[$doc_type]->id;
		$cache_key = $template ."|". $doc_type .".". $doc_id;
		if(\Laravel\Cache::has($cache_key)) {
			return \Laravel\Cache::get($cache_key);
		}
		$view = parent::make($template, $data);
		\Laravel\Cache::put($cache_key, $view->render(), 5);
		return $view;
	}

}