D3Up.com - Version 2.0
---

Welcome to the D3Up.com Github Repository!

I've finally made the decision to release the source code to D3Up.com so that everyone able can help contribute and possibly modify it for other games!

Components
===

D3Up uses the following frameworks/bundles:

- [Laravel v3](http://laravel.com) - PHP MVC/MVR Framework
  - MyUnit (Bundle) - PHPUnit Wrapper for Laravel
  - Binder (Bundle) - HTML Helpers
	- S3 (Bundle) - Allows communication with Amazon S3
- [EpicMongo](http://github.com/aaroncox/epicmongo) - PHP/MongoDB ORM
- [jQuery](http://jquery.com) - Javascript Engine
- [underscore](http://underscorejs.org) - Javascript Framework (the Calculators use)
- [HandleBars](http://handlebarsjs.com) - Javascript Templating Engine
- [Bootstrap](twitter.github.com/bootstrap/base-css.html) - CSS Framework / Utilities

Installation
===

If you're wanting to setup a local instance of D3Up, here's a few things you'll need to do:

- Fork the repository so you have your own copy to work on and submit pull requests from.
- Copy `application/config/application.template` to `application/config/application.php` and change the `key` in the file to a unique value.
- Make sure to run `git submodule update --init` to pull in a copy of the libraries/bundles it uses.

Passing the Unit Tests
===

My goal here is to ensure all tests (located in the `application/tests` folder) pass after any changes are made. More and more tests will be added to test the PHP code and ensure no changes break the site's functionality.

A javascript testing framework will be added as well in the future, but right now, the javascript is kinda an abomination :)

You can run the tests by executing the following command from the command line (in the D3Up.com folder):

`php artisan myunit`

This requires that PHPUnit is installed on your system, just google for `phpunit installation [insert your OS here]` to find out how.

Submitting Changes
===

All changes submitted must be in the form of a *Pull Request*, which will then be reviewed by the community and once accepted, will be merged into the live codebase and deployed to D3Up.com.
