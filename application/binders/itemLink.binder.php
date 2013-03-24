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
	if(isset($params['compare']) && $params['compare'] != false) {
		$options['data-compare'] = $params['slot'];	
	}
	if(isset($params['toggle']) && $params['toggle'] === true) {
		$options['data-toggle'] = 'tab';
		$link = "#tab-item-".$item->id;
	}
	if(isset($params['text'])) {
		$text = $params['text'];
	} else {
		$text = $item->name;
	}
	return HTML::link(
		$link,
		$text, 
		$options
	);
});