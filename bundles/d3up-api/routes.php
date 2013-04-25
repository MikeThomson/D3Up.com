<?php
// Disable the Profiler for all of these routes
Config::set('application.profiler', false);

Route::get('(:bundle)/build/(:any?)', function($class = null) {
	$query = array(
		'public' => true,
	);
	$sort = array();
	if($sortBy = Input::get('sort')) {
		switch($sortBy) {
			case "dps":
				$sort['stats.dps'] = -1;
				break;
			case "ehp":
				$sort['stats.ehp'] = -1;
				break;
		}
	}
	$limit = Input::get('limit', 100);
	$skip = $limit * (Input::get('page', 1) - 1);
	if(Input::get('actives') && $actives = explode("|",Input::get('actives'))) {
		$query['actives'] = array('$all' => $actives);
	}
	if($limit > 100) {
		return Response::json(['Error' => 'The maximum results per request is 100.']);
	}
	if($skip >= 10000) {
		return Response::json(['Error' => 'The depth of pagination is 100, limiting you to 10,000 results maximum. Please refine your query if you are seeking something specific.']);		
	}
	if($class || $class = Input::get('class')) {
		$query['class'] = $class;
	}
	$results = Epic_Mongo::db('build')
								->find($query)
								->sort($sort)
								->skip($skip)
								->limit($limit);
	if(Input::get('explain')) {		
		return View::make('api.explain')
								->with('info', $results->getInnerIterator()->info())
								->with('explain', $results->getInnerIterator()->explain());
	}
	return Response::json($results->json());
});


Route::get('(:bundle)/time', function() {
	return View::make('api/time');
});