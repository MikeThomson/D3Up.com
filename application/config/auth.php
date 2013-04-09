<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Default Authentication Driver
	|--------------------------------------------------------------------------
	*/

	'driver' => 'epic_mongo',

	/*
	|--------------------------------------------------------------------------
	| Authentication Username / Username Alternate Field(s)
	|--------------------------------------------------------------------------
	*/

	'username' => 'email',
	'username_alt' => 'username',

	/*
	|--------------------------------------------------------------------------
	| Authentication Password Field
	|--------------------------------------------------------------------------
	*/

	'password' => 'password',

	/*
	|--------------------------------------------------------------------------
	| Authentication Model
	|--------------------------------------------------------------------------
	|
	| Epic_Mongo's Laravel Auth Adapter can use this setting to determine which
	| model that users should be loaded as.
	|
	*/

	'model' => 'D3Up_User',

);