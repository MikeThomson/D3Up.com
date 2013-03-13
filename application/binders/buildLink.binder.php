<?php
return array('html buildLink' => function($build, $params = array()) {
	if(!$build) {
		return null;
	}
	// Default Link
	$link = '/b/'.$build->id;
	// Define the Default Data for the Link
	$options = array(
		// 'id' => 'item-'.$item->id,
		// 'data-json' => json_encode($item->tooltip()),
		// 'class' => implode(" ", array(
		// 	'quality-'.$item->quality,
		// )),
	);
	// Conditional Options
	return HTML::link(
		$link,
		$build->name, 
		$options
	);
});