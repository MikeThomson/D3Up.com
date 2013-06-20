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
		// Grab the Item
		$item = Epic_Mongo::db('item')->findOne(array('id' => (int) $id));
		// Start building the Query
		$query = array(
			'id' => (int) $id, 
			'break' => true
		);
		// Start building the Update
		$update = array(
			'$set' => array(),
			'$unset' => array(),
		);
		// Did the user request the name change?
		if($name = Input::get('name')) {
			$update['$set']['name'] = $name;
		}
		// Did the user request the type change?
		if($type = Input::get('type')) {
			$update['$set']['type'] = $type;
		}
		// Did the user request the qualitys change?
		if($quality = Input::get('quality')) {
			$update['$set']['quality'] = (int) $quality;			
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
					// Append the query to $update
					$update['$unset']['attrs.' . $k] = 1;
				} else {
					// Do we have a sub-array key?
					if($k2) {
						// Append the query to $update with attrs.$k.$k2 = $v
						$update['$set']['attrs.' . $k . '.' . $k2] = (float) $v;																
					} else {
						// Append the query to $update with attrs.$k = $v
						$update['$set']['attrs.' . $k] = (float) $v;										
					}
				}				
			}					
		}
		$unsetSockets = false;
		// Were any sockets passed?
		if($sockets = Input::get('sockets')) {
			foreach($sockets as $k => $v) {
				if($v === "null") {
					$unsetSockets = true;
					$update['$unset']['sockets.' . $k] = 1;
				} else {
					$update['$set']['sockets.' . $k] = $v;
				}
			}
		}
		// Were any stats passed?
		if($stats = Input::get('stats')) {
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
					$update['$unset']['stats.' . $k] = 1;
				} else {
					// Do we have a sub-array key?
					if($k2) {
						// Append the query to $update with stats.$k.$k2 = $v
						$update['$set']['stats.' . $k . '.' . $k2] = (float) $v;																
					} else {
						// Append the query to $update with stats.$k = $v
						$update['$set']['stats.' . $k] = (float) $v;										
					}
				}				
			}			
		}
		// If we don't have $unset actions, remove it
		if(empty($update['$unset'])) {
			unset($update['$unset']);
		}
		// If we don't have $set actions, remove it
		if(empty($update['$set'])) {
			unset($update['$set']);
		}
		// var_dump($update); exit;
		if(!empty($update)) {
			// Perform our Update
			Epic_Mongo::db('item')->update($query, $update);
			// The way gem's are getting unset, it's placing nulls in place.
			// This removes all the excess "null" values
			if($unsetSockets) {
				$fixSockets = array(
					'$pullAll' => array(
						'sockets' => array(null)
					)
				);
				Epic_Mongo::db('item')->update($query, $fixSockets);				
			}
			// Grab the Item (Again)
			//		This is terrible that I'm loading it twice... I'll get around to 
			//		rewriting this at some point. Right now Epic_Mongo has issues with
			//		deep changes inside arrays, so I can't really just modify the item
			//		as it was loaded the first time. 
			//		- The item was loaded at the top for Auth Checks
			//		- The update is then performed
			//		- Then the item is reloaded to show the changes
			//		These are relatively inexpensive queries, so for beta, I think it'll
			//		be ok.
			$item = Epic_Mongo::db('item')->findOne(array('id' => (int) $id));			
		}
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