<?php
/*
|--------------------------------------------------------------------------
| itemLink - Automatic Item Links
|--------------------------------------------------------------------------
|
| A helper to automatically create a link to an item from within blade templates.
| 
| Usage: HTML::itemLink($item)
| Parameters: The $params variable is an array that you can pass in:
| 							- slot: the slot this item is equipped in (for the calculator)
|								- text: a string, the text will be used to replace the name
|								- compare: boolean, if set to true, will cause multiple tooltips
|														all items with matching slot (for the compare screen)
| Output: <a href='/i/#'>Item Name</a>
|
*/
return array('html itemLink' => function($item, $params = array()) {
	// If we didn't recieve an item, return null
	if(!$item || !$item instanceOf D3Up_Item) {
		return null;
	}
	// Default Link
	$link = '/i/'.$item->id;
	// Define the Default Data for the Link
	$options = array(
		'data-id' => $item->id,
		'data-type' => 'item',
		'data-json' => json_encode($item->tooltip()),
		'class' => implode(" ", array(
			'quality-'.$item->quality,
		)),
	);
	// Conditional Parameters
	if(!empty($params)) {
		// The slot parameter is appended to data-slot on the item and used for the calculator
		if(isset($params['slot'])) {
			$options['data-slot'] = $params['slot'];
		}
		// The compare parameter can be set to true and will cause all tooltips with a matching slot to tooltip
		if(isset($params['compare']) && $params['compare'] != false) {
			$options['data-compare'] = $params['slot'];	
		}
		// Replacement text for the Link
		if(isset($params['text'])) {
			$text = $params['text'];
		} else {
			$text = $item->name;
		}		
	}
	// Return the Link
	return HTML::link(
		$link,
		$text, 
		$options
	);
});