<?php

abstract class ModelTestCase extends PHPUnit_Framework_TestCase
{
	
	public function __construct() {
		Bundle::start('epic_mongo');
	}
	
}