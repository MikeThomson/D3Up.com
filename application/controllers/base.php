<?php

class Base_Controller extends Controller {

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}
	
	public function __construct() {
		if(!Session::has('locale')) {
			$langs = Config::get('application.languages');
			Session::put('locale', Config::get('application.language'));
			Session::put('locale_name', $langs[Config::get('application.language')]);
		} else {
			Config::set('application.language', Session::get('locale'));
		}
		parent::__construct();
	}

	public function action_locale($locale) {
		if(isset($locale)) {
			foreach(Config::get('application.languages') as $lang => $name) {
				if($locale == $lang) {
					Session::put('locale', $locale);
					Session::put('locale_name', $name);
				}
			}
		}
		return Redirect::to(Request::server('http_referer'));
	}

}
// 
// class Language_Controller extends Base_Controller {
// 	function __construct(){
// 		$this->action_set();
// 		parent::__construct();
// 	}
// 	
// 	private function checkLang($lang = null){
// 		if(isset($lang)){
// 			foreach($this->_Langs as $k => $v){
// 				if(strcmp($lang, $k) == 0) $Check = true;
// 			}
// 		}
// 		return isset($Check) ? $Check : false;
// 	}
// 
// 	public function action_set($lang = null){
// 		if(isset($lang) && $this->checkLang($lang)){
// 			Session::put('lang', $lang);
// 			$this->_Langs['current'] = $lang;
// 			Config::set('application.language', $lang);
// 		} else {
// 			if(Session::has('lang')){
// 				Config::set('application.language', Session::get('lang'));
// 				$this->_Langs['current'] = Session::get('lang');
// 			} else {
// 				$this->_Langs['current'] = $this->_Default;
// 			}
// 		}
// 		return Redirect::to('/');
// 	}
// }