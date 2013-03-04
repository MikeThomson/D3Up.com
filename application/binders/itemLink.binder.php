<?php
return array('html itemLink' => function($item, $params = array()) {
	if(!$item) {
		return null;
	}
	// Default Link
	$link = '/i/'.$item->id;
	// Define the Default Data for the Link
	$options = array(
		// 'id' => 'item-'.$item->id,
		'data-json' => json_encode($item->tooltip()),
		'class' => implode(" ", array(
			'quality-'.$item->quality,
		)),
	);
	// Conditional Options
	if(isset($params['slot'])) {
		$options['data-slot'] = $params['slot'];
	}
	if(isset($params['toggle']) && $params['toggle'] === true) {
		$options['data-toggle'] = 'tab';
		$link = "#tab-item-".$item->id;
	}
	return HTML::link(
		$link,
		$item->name, 
		$options
	);
});