<?php
/**
 * Copyright 2010 - 2013, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2013, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

class AllTinyMCEPluginTest extends PHPUnit_Framework_TestSuite {

/**
 * Suite define the tests for this suite
 *
 * @return void
 */
	public static function suite() {
		$suite = new PHPUnit_Framework_TestSuite('All TinyMCE Plugin Tests');

		$basePath = CakePlugin::path('TinyMCE') . DS . 'Test' . DS . 'Case' . DS;

		$suite->addTestFile($basePath . 'View' . DS . 'Helper' . DS . 'TinyMceHelperTest.php');

		return $suite;
	}

}