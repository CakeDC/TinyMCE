<?php
/**
 * CakePHP TinyMce Plugin
 *
 * Copyright 2009 - 2010, Cake Development Corporation
 *                        1785 E. Sahara Avenue, Suite 490-423
 *                        Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright 2009 - 2010, Cake Development Corporation (http://cakedc.com)
 * @link      http://github.com/CakeDC/TinyMce
 * @package   plugins.tags
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::import('Core', array('View', 'Helper'));
App::import('Helper', array('Html', 'TinyMce.TinyMce'));

class TinyMceTestCase extends CakeTestCase {

/**
 * Helper being tested
 *
 * @var object TinyMceHelper
 * @access public
 */
	public $TinyMce;

/**
 * @var array
 * @access public
 */
	public $configs = array(
		'testConfig' => array());

/**
 * @return void
 * @access public
 */
	public function startTest() {
		ClassRegistry::flush();
		Router::reload();
		$null = null;
		$this->View = new View($null);
		$this->TinyMce = new TinyMceHelper();
		$this->TinyMce->Html = new HtmlHelper();
	}

/**
 * @return void
 * @access public
 */
	public function endTest() {
		unset($this->TinyMce, $this->View);
	}

/**
 * @return void
 * @access public
 */
	public function testEditor() {
		ClassRegistry::removeObject('view');
		ClassRegistry::addObject('view', $this->View);
		$this->TinyMce->editor(array(
			'theme' => 'advanced'));

		$this->expectException('OutOfBoundsException');
		$this->TinyMce->editor('invalid-config');
	}

}
?>