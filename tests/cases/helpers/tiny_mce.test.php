<?php
/**
 * CakePHP TinyMCE Plugin
 *
 * Copyright 2009 - 2010, Cake Development Corporation
 *                        1785 E. Sahara Avenue, Suite 490-423
 *                        Las Vegas, Nevada 89104
 *
 * Licensed under The LGPL License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright 2009 - 2010, Cake Development Corporation (http://cakedc.com)
 * @link      http://github.com/CakeDC/TinyMCE
 * @package   plugins.tiny_mce.tests.cases.helpers
 * @license   LGPL License (http://www.opensource.org/licenses/lgpl-2.1.php)
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
	public $TinyMce = null;

/**
 * @var array
 * @access public
 */
	public $configs = array(
		'simple' => array(
			'mode' => 'textareas',
			'theme' => 'simple',
			'editor_selector' => 'mceSimple'),
		'advanced' => array(
			'mode' => 'textareas',
			'theme' => 'advanced',
			'editor_selector' => 'mceAdvanced'));

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
		$this->assertEqual($this->View->__scripts[0], '<script type="text/javascript">
//<![CDATA[
tinyMCE.init({
theme : "advanced",
});

//]]>
</script>');


		$this->TinyMce->configs = $this->configs;
		$this->TinyMce->editor('simple');
		$this->assertEqual($this->View->__scripts[1], '<script type="text/javascript">
//<![CDATA[
tinyMCE.init({
mode : "textareas",
theme : "simple",
editor_selector : "mceSimple",
});

//]]>
</script>');

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
		$this->assertTrue(isset($this->View->__scripts[0]));
		$this->assertEqual($this->View->__scripts[0], '<script type="text/javascript" src="/tiny_mce/js/tiny_mce/tiny_mce.js"></script>');
	}
}
?>