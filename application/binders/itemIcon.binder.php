<?php
return array('html itemIcon' => function($item) {
	if(!$item->icon) {
		return null;
	}
	// return HTML::image('http://media.blizzard.com/d3/icons/items/small/'.$item->icon.'.png', $item->name);
});