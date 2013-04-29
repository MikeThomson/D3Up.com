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
		if(!Cookie::has('d3up_lang')) {
			$langs = Config::get('application.languages');
			Cookie::put('d3up_lang', Config::get('application.language'));
		} else {
			Config::set('application.language', Cookie::get('d3up_lang'));
		}
		parent::__construct();
	}

	public function action_locale($locale) {
		if(isset($locale)) {
			foreach(Config::get('application.languages') as $lang => $name) {
				if($locale == $lang) {
					// This cookie is now required to tell nginx which localization we're working with
					if($locale == 'en') {
						Cookie::forget('d3up_lang');												
					} else {
						Cookie::forever('d3up_lang', $locale);						
					}	
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