<?php
/**
 * undocumented class
 *
 * @package default
 * @author Aaron Cox
 **/
class D3Up_GearSet extends Epic_Mongo_Document
{
		
	protected $_requirements = array(
		'helm' => array('doc:item', 'ref'),
		'shoulders' => array('doc:item', 'ref'),
		'amulet' => array('doc:item', 'ref'),
		'chest' => array('doc:item', 'ref'),
		'gloves' => array('doc:item', 'ref'),
		'bracers' => array('doc:item', 'ref'),
		'belt' => array('doc:item', 'ref'),
		'pants' => array('doc:item', 'ref'),
		'ring1' => array('doc:item', 'ref'),
		'ring2' => array('doc:item', 'ref'),
		'boots' => array('doc:item', 'ref'),
		'mainhand' => array('doc:item', 'ref'),
		'offhand' => array('doc:item', 'ref'),
	);
	
	// public $_gearMap = array(
	// 	'helm' => array('spirit-stone','voodoo-mask','wizard-hat','helm'),
	// 	'shoulders' => array('shoulders'),
	// 	'amulet' => array('amulet'),
	// 	'chest' => array('chest','cloak'),
	// 	'gloves' => array('gloves'),
	// 	'bracers' => array('bracers'),
	// 	'belt' => array('belt','mighty-belt'),
	// 	'pants' => array('pants'),
	// 	'ring1' => array('ring'),
	// 	'ring2' => array('ring'),
	// 	'boots' => array('boots'),
	// 	'mainhand' => array('2h-mace', '2h-axe', 'bow', 'daibo', 'crossbow', '2h-mighty', 'polearm', 'staff', '2h-sword', 'ceremonial-knife', 'wand', 'axe', 'hand-crossbow', 'dagger', 'fist-weapon', 'mace', 'mighty-weapon', 'spear', 'sword'),
	// 	'offhand' => array('axe', 'hand-crossbow', 'dagger', 'fist-weapon', 'mace', 'mighty-weapon', 'spear', 'sword', 'mojo', 'source', 'quiver', 'shield'),
	// );
	// 
	// public function getSlots() {
	// 	$slots = array_keys($this->_requirements);
	// 	unset($slots[13]);
	// 	return $slots;
	// }
	// 
	// public function getAcceptableTypes($type) {
	// 	if(!$type) return null;
	// 	return $this->_gearMap[$type];
	// }
	// 
	// public function getGearJson() {
	//   $data = array();
	//   foreach($this->_requirements as $slot => $reqs) {
	//     if($this->$slot) {
	//         $data[$slot] = $this->$slot->cleanExport();
	//     }
	//   }
	//     return json_encode($data);
	// }
} // END class D3Up_Mongo_GearSet extends Epic_Mongo_Document