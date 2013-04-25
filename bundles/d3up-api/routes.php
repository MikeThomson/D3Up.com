<?php
Route::get('(:bundle)/build', function() {
	$query = array(
		'public' => true,
	);
	$sort = array(
		'stats.dps' => -1
	);
	$limit = Input::get('limit', 100);
	$skip = $limit * (Input::get('page', 1) - 1);
	if(Input::get('skills') && $skills = explode("|",Input::get('skills'))) {
		$query['skills'] = array('$all' => $skills);
	}
	if($limit > 100) {
		return Response::json(['Error' => 'The maximum results per request is 100.']);
	}
	if($skip >= 10000) {
		return Response::json(['Error' => 'The depth of pagination is 100, limiting you to 10,000 results maximum. Please refine your query if you are seeking something specific.']);		
	}
	if($class = Input::get('class')) {
		$query['class'] = $class;
	}
	$results = Epic_Mongo::db('build')
								->find($query)
								->sort($sort)
								->skip($skip)
								->limit($limit);
	if(Input::get('explain')) {		
		var_dump($results->getInnerIterator()->info());
		var_dump($results->getInnerIterator()->explain()); exit;
	}
	return Response::json($results->json());
});


Route::get('(:bundle)/time', function() {
	return View::make('api/time');
});