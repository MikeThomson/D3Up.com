<?php
/*
|--------------------------------------------------------------------------
| itemIcon - Item Icon Generator
|--------------------------------------------------------------------------
|
| A helper that allows you to pass in an item and get the appropriate image
| from battle.net.
| 
| Usage: HTML::itemIcon($item, $params)
| Parameters: The $params variable is an array that you can pass in:
| 							- size: 'small', 'medium', 'large'
|								- class: a string, will append it as a class to the image
| Output: <span><img [classes]></span>
| 
*/
return array('html itemIcon' => function($item, $params = array()) {
	// If the item isn't an item or doesn't have an icon, return null
	if(!$item || !$item->icon || !$item instanceOf D3Up_Item) {
		return null;
	}
	// Any options we're going to be passing along to the image
	$options = array();
	// Define Params
	$size = 'small';
	// Parse any parameters passed in
	if(!empty($params)) {
		// Modify the size based on the params
		if(isset($params['size'])) {
			$size = $params['size'];
		}
		// Add a class to the image's options
		if(isset($params['class'])) {
			$options['class'] = $params['class'];
		}
	}
	// Generate the Image
	$image = HTML::image('http://media.blizzard.com/d3/icons/items/'.$size.'/'.$item->icon.'.png', $item->name, $options);
	// Wrap it in a span and return
	return "<span class='item-icon-box item-icon item-quality-".$item->quality."'>".$image."</span>";
});
