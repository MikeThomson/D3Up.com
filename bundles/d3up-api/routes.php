<?php
Route::get('(:bundle)/builds/(:any?)', function($class = null) {
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
		return Response::json(['error' => 'The maximum results per request is 100.']);
	}
	if($skip >= 10000) {
		return Response::json(['error' => 'The depth of pagination is 100, limiting you to 10,000 results maximum. Please refine your query if you are seeking something specific.']);		
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

Route::get('(:bundle)/(:any)/(:num)/(:all?)', function($collection, $id) {
	if(!in_array($collection, ['item', 'build'])) {
		return Response::json(['error' => 'The requested data type of \''.$collection.'\' is invalid.']);		
	}
	$query = array(
		'id' => (int) $id,
	);
	$result = Epic_Mongo::db($collection)->findOne($query);
	if(!$result) {
		return Response::json(['error' => 'Unable to load '.$collection." with id ".$id]);
	}
	if(Input::get('explain')) {		
		return View::make('api.explain')
								->with('info', $results->getInnerIterator()->info())
								->with('explain', $results->getInnerIterator()->explain());
	}
	return Response::json($result->json());
});


Route::get('(:bundle)/user/(:any)/(:all?)', function($collection) {
	if(!Auth::check()) {
		return Response::json(['error' => 'You must be logged in to access your data through the API.']);
	}
	if(!in_array($collection, ['item', 'build'])) {
		return Response::json(['error' => 'The requested data type of \''.$collection.'\' is invalid.']);		
	}
	$query = array(
		'_createdBy' => Auth::user()->createReference()
	);
	if($type = Input::get('type')) {
		$query['type'] = $type;
	}
	$sort = array();
	if($sortBy = Input::get('sort')) {
		switch($sortBy) {
			case "oldest":
				$sort['_created'] = 1;
				break;
			case "newest":
				$sort['_created'] = -1;
				break;
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
	if($limit > 100) {
		return Response::json(['error' => 'The maximum results per request is 100.']);
	}
	if($skip >= 10000) {
		return Response::json(['error' => 'The depth of pagination is 100, limiting you to 10,000 results maximum. Please refine your query if you are seeking something specific.']);		
	}
	$results = Epic_Mongo::db($collection)
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