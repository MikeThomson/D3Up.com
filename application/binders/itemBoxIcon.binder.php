<?php
return array('html itemBoxIcon' => function($item, $params = array()) {
	if(!$item || !$item->icon) {
		return null;
	}
	$options = array();
	// Define Params
	$size = 'small';
	$class = null;
	if(!empty($params)) {
		if(isset($params['size'])) {
			$size = $params['size'];
		}
		if(isset($params['class'])) {
			$options['class'] = $params['class'];
		}
	}
	// $options = array(
		// 'class' => 'item-icon item-quality-'.$item->quality
	// );
	$image = HTML::image('http://media.blizzard.com/d3/icons/items/'.$size.'/'.$item->icon.'.png', $item->name, $options);
	return "<span class='item-icon-box item-icon item-quality-".$item->quality." ".$class."'>".$image."</span>";
});
