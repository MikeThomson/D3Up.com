<?php

class Item_Controller extends Base_Controller {

	public $restful = true;
	public $layout = 'template.main';
	
	public function get_view($id) {
		$item = Epic_Mongo::db('item')->findOne(array('id' => (int) $id));
		if(!$item) {
			return Response::error('404');
		}
		$this->layout->nest('content', 'item.view', array(
			'item' => $item,
		));
	}
	
	public function post_edit($id) {
		// Start building the Query
		$query = array(
			'id' => (int) $id, 
			// 'break' => true
		);
		// Grab the Item
		$item = Epic_Mongo::db('item')->findOne($query);
		// Did the user request the name change?
		if($name = Input::get('name')) {
			$item->name = $name;
		}
		// Did the user request the type change?
		if($type = Input::get('type')) {
			$item->type = $type;
		}
		// Did the user request the qualitys change?
		if($quality = Input::get('quality')) {
			$item->quality = (int) $quality;			
		}
		// Get all valid attrs and stats
		$valid_attrs = array_keys(D3Up_Attributes::$attributes['en']);
		$valid_stats = array('block-chance', 'block-amount', 'damage', 'speed', 'armor');
		// Were any attrs passed?
		if($attrs = Input::get('attrs')) {
			foreach($attrs as $k => $v) {
				// $k2 is our subkey, incase the value is a sub-array
				//	Example: attrs.fire-damage = {min: 1, max: 2}
				//	As opposed to attrs.strength = 100				
				$k2 = false;
				// If we have a ~ in the key, it's a sub-array
				if (strpos($k,'~') !== false) {
					// Explode by the ~ and reassign the values
					list($k, $k2) = explode("~", $k);
				}
				// If the value passed was "null" or a "0", unset the value
				if($v === "null" || $v === "0") {
					// Null out the value in the attrs document
					$item->attrs->$k = null;
				} else {
					// Do we have a sub-array key?
					if($k2) {
						// Append the query to $update with attrs.$k.$k2 = $v
						$item->attrs->$k->$k2 = (float) $v;
					} else {
						// Append the query to $update with attrs.$k = $v
						$item->attrs->$k = (float) $v;
					}
				}				
			}					
		}
		// Were any sockets passed?
		if($sockets = Input::get('sockets')) {
			$modified = $item->sockets->export();
			foreach($sockets as $k => $v) {
				if($v === "null" || $v === null) {
					unset($modified[$k]);
				} else {
					$modified[$k] = $v;
				}
			}
			$item->sockets = array_values($modified);
		}
		// Were any stats passed?
		if($stats = Input::get('stats')) {
			$modified = $item->stats ?: new Epic_Mongo_Document;
			foreach($stats as $k => $v) {
				// $k2 is our subkey, incase the value is a sub-array
				//	Example: stats.damage = {min: 1, max: 2}
				//	As opposed to stats.armor = 100				
				$k2 = false;
				// If we have a ~ in the key, it's a sub-array
				if (strpos($k, '~') !== false) {
					// Explode by the ~ and reassign the values
					list($k, $k2) = explode("~", $k);
				}
				// If the value passed was "null" or a "0", unset the value
				if($v === "null" || $v === "0") {
					// Append the query to $update
					$modified->$k = null;
				} else {
					// Do we have a sub-array key?
					if($k2) {
						if(!$modified->$k) {
							$modified->$k = new Epic_Mongo_Document;
						}
						// Append the query to $update with stats.$k.$k2 = $v
						$modified->$k->$k2 = (float) $v;
					} else {
						// Append the query to $update with stats.$k = $v
						$modified->$k = (float) $v;
					}
				}				
			}			
		}
		// Save the Item (whole/deep save & modifiedBuilds)
		$item->save(true, true);
		// Return the item and HTML as JSON
		return json_encode(array(
			'html' => View::make('item.display', array('item' => $item)) . "",
			'item' => $item->json(),
		));
	}
	
	public function get_edit($id) {
		$item = Epic_Mongo::db('item')->findOne(array('id' => (int) $id));
		if(!$item) {
			return Response::error('404');
		}
		$this->layout->nest('content', 'item.edit', array(
			'item' => $item,
		));		
	}
}