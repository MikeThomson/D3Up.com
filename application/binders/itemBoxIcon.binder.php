<?php
return array('html itemBoxIcon' => function($item) {
	if(!$item->icon) {
		return null;
	}
	$options = array(
		// 'class' => 'item-icon item-quality-'.$item->quality
	);
	$image = HTML::image('http://media.blizzard.com/d3/icons/items/small/'.$item->icon.'.png', $item->name, $options);
	return "<span class='item-icon-box item-icon item-quality-".$item->quality."'>".$image."</span>";
});
