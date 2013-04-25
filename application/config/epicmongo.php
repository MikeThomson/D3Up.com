<?php
return array(
	/*
	|--------------------------------------------------------------------------
	| host - Server Connection String
	|--------------------------------------------------------------------------
	*/
	'host' => '127.0.0.1',
	/*
	|--------------------------------------------------------------------------
	| dbname - The name of the Database to use
	|--------------------------------------------------------------------------
	*/
	'dbname' => 'com_d3up',
	/*
	|--------------------------------------------------------------------------
	| schema - The Schema File loaded alongside Epic_Mongo's default schema
	|--------------------------------------------------------------------------
	*/
	'schema' => 'D3Up_Schema',
	/*
	|--------------------------------------------------------------------------
	| typemap - The array that maps Models to MongoDB Documents
	|--------------------------------------------------------------------------
	*/
	'typemap' => array(
		'build' => 'D3Up_Build',
		'guide' => 'D3Up_Guide',
		'guide_section' => 'D3Up_Guide_Section',
		'guide_sections' => 'D3Up_Guide_Sections',
		'item' => 'D3Up_Item',
		'math' => 'D3Up_Math',
		'math_revision' => 'D3Up_Math_Revision',
		'localized' => 'D3Up_Localized',
		'gearset' => 'D3Up_GearSet',
		'gearsetcache' => 'D3Up_GearSet_Cache',
		'cursor:build' => 'D3Up_Mongo_Iterator_Cursor_Build',
		'cursor:item' => 'D3Up_Mongo_Iterator_Cursor',
	)
);