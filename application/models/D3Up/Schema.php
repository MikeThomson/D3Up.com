<?php
class D3Up_Schema extends Epic_Mongo_Schema_Laravel {
	
	protected $_indexes = array(
		/*-------------------------------------------------------------------------
		| Example Index Array
		|   The key of the array is the name of the collection, and the array 
		|   is filled with an additional array for each index. The key is the name
		|   of the index and the array within is the actual index.
		|   				
		| 'collection' => array(			The key is the collection, and contains an array of indexes
		| 	'index name' => array('field' => true)		The Index to Maintain (will be JSON encoded)
		| )
		|------------------------------------------------------------------------*/
		'builds' => array(	
			/*-------------------------------------------------------------------------
			| Indexes for Builds
			|   All new indexes for V2 and some from V1 will be moved into this section
			|   as they are deemed needed.
			|------------------------------------------------------------------------*/
			'public_1' => array(
				'public' => 1,
			),
			'public_1_statsehp_1' => array(
				'public' => 1, 
				'stats.ehp' => -1, 
				'sparse' => true,
			),
			'public_1_statsdps_1' => array(
				'public' => 1, 
				'stats.dps' => -1, 
				'sparse' => true,
			),
			'public_1_class_1_actives_1' => array(
				'actives' => 1,
				'class' => 1,
				'public' => 1,
				'sparse' => true,
			),
			'public_1_statsdps_1' => array(
				'public' => 1, 
				'class' => 1,
				'stats.dps' => -1, 
				'sparse' => true,
			),
			'public_1_statsehp_1' => array(
				'public' => 1, 
				'class' => 1,
				'stats.dps' => -1, 
				'sparse' => true,
			),
			// Build Quick Access
			//		Used by the User Navbar to load the user's builds
			'_createdBy_1_paragon_1_level_1' => array(
				'_createdBy' => 1,
				'paragon' => -1,
				'level' => -1
			),
			/*-------------------------------------------------------------------------
			| Legacy Indexes for Builds
			|   These indexes are used for V1 of D3Up. Some of them could possibly be 
			|   removed after V2 goes live to free up disk space. 
			|------------------------------------------------------------------------*/
			'stats.ehp_1' => array('stats.ehp' => 1),
			'stats.dps_1' => array('stats.ehp' => 1),
			'_created_1' => array('_created' => 1),
			'_createdBy_1__type_1' => array('_createdBy' => 1, '_type' => 1),
			'_characterBt_1' => array('_characterBt' => 1),
			'id_1__type_1' => array('id' => 1, '_type' => 1),
			'private_1_class_1__type_1' => array(
				'private' => 1,
				'class' => 1,
				'_type' => 1,
			),
			'private_1_stats.dps_1__type_1' => array(
				'private' => 1,
				'stats.dps' => 1,
				'_type' => 1,
			),
			'private_1_stats.dps_1_class_1__type_1' => array(
				'private' => 1,
				'stats.dps' => 1,
				'_type' => 1,
				'class' => 1,
			),
		), 
		'items' => array(
			/*-------------------------------------------------------------------------
			| Indexes for Builds
			|   All new indexes for V2 and some from V1 will be moved into this section
			|   as they are deemed needed.
			|------------------------------------------------------------------------*/
			'_d3id' => array('_d3id' => 1),			
			/*-------------------------------------------------------------------------
			| Legacy Indexes for Builds
			|   These indexes are used for V1 of D3Up. Some of them could possibly be 
			|   removed after V2 goes live to free up disk space. 
			|------------------------------------------------------------------------*/
			'_created_1' => array('_created'),
			'_createdBy_1__type_1' => array('_createdBy' => 1, '_type' => 1),
			'id_1__type_1' => array('id' => 1, '_type' => 1),
		)
	);
	
	protected $_existing = array();
	
	/*
		ensureAllIndexes - Ensures the Existance of any indexes specified on a document class
	*/
	public function ensureIndexes() {
		// Loop through our indexes array
		foreach($this->_indexes as $collectionName => $indexes) {
			// Get the Collection
			$collection = $this->getMongoDb()->$collectionName;
			echo "\n\nStarting on collection ".$collectionName."\n";
			// Set which Indexes currently exist for this collection
			$this->_existing[$collectionName] = array_map(function($i) { return $i['name']; }, $collection->getIndexInfo());
			// An array to contain which indexes are checked
			$used = array(
				'_id_' // It's always used, don't mess with it
			);
			echo "?? Checking on existance of Indexes\n";
			foreach($indexes as $name => $index) {
				$sparse = false;
				// Check to see if we have a sparse key
				if(isset($index['sparse']) && $index['sparse'] == true) {
					$sparse = true;
					unset($index['sparse']);	// Unset it in the array
				}
				$used[] = $name;
				if(!in_array($name, $this->_existing[$collectionName])) {
					echo "  ++ Creating ".$name." on ".$collectionName."\n";
					$results = $collection->ensureIndex($index, array(
						"background" => true,
						"name" => $name,
						"sparse" => $sparse,
					));						
				} else {
					echo "     Skipping ".$name." on ".$collectionName." (Exists)\n";
				}
			}
			$this->_checkUnused($used, $collection);
		}
	}
	
	protected function _checkUnused($used, $collection) {
		$collectionName = $collection->getName();
		echo "?? Checking for unused Indexes on ".$collectionName."\n";
		foreach(array_diff($this->_existing[$collectionName], $used) as $old) {
			echo "  -- Removing Unused Index: ".$old."\n";
			$this->getMongoDb()->command(array(
				"deleteIndexes" => $collectionName, 
				"index" => $old,
			));
		}
	}
}