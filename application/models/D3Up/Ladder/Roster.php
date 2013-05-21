<?php

class D3Up_Ladder_Roster extends Epic_Mongo_DocumentSet {

  protected $_requirements = array(
		'$' => array('doc:build', 'ref'),
  );

}