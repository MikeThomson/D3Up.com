<?php
/*
|--------------------------------------------------------------------------
| Laravel Bundles
|--------------------------------------------------------------------------
|
| These are all of the Bundles that D3Up.com uses within laravel. These bundles
| are located in the /bundles/ folder. Many of them are submodules that can be
| updated/fetched with:
| 
| git submodule update --init
| 
*/
return array(
	/* ------------------------------------------------------------------------
	| epic_mongo - MongoDB Adapter
	|------------------------------------------------------------------------ */
	'epic_mongo' => array('auto' => true),
	/* ------------------------------------------------------------------------
	| binder - Extensions/Addons for HTML/Blade Templating
	|------------------------------------------------------------------------ */
	'binder' => array('auto' => true),
	/* ------------------------------------------------------------------------
	| myunit - PHPUnit Wrapper for Laravel
	|------------------------------------------------------------------------ */
	'myunit',
	/* ------------------------------------------------------------------------
	| s3 - Amazon S3 Wrapper for Easy Uploading
	|------------------------------------------------------------------------ */
	's3' => array('auto' => true),
);