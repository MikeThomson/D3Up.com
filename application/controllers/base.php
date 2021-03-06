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