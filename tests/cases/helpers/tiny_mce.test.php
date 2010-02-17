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
 * startTest
 *
 * @return void
 * @access public
 */
	public function startTest() {
		ClassRegistry::flush();
		Router::reload();
		$null = null;
		$this->View = new View($null);
		ClassRegistry::removeObject('view');
		ClassRegistry::addObject('view', $this->View);
		$this->TinyMce = new TinyMceHelper();
		$this->TinyMce->Html = new HtmlHelper();
	}

/**
 * endTest
 *
 * @return void
 * @access public
 */
	public function endTest() {
		unset($this->TinyMce, $this->View);
	}

/**
 * testEditor
 *
 * @return void
 * @access public
 */
	public function testEditor() {
		$this->TinyMce->editor(array(
			'theme' => 'advanced'));

		$this->TinyMce->configs = $this->configs;
		$this->TinyMce->editor('testConfig');

		$this->expectException('OutOfBoundsException');
		$this->TinyMce->editor('invalid-config');
	}

/**
 * testBeforeRender
 *
 * @return void
 * @access public
 */
	public function testBeforeRender() {
		$this->TinyMce->beforeRender();
		//debug($this->View->__scripts);
	}

}
?>