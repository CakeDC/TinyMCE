<?php
/**
 * CakePHP TinyMce Plugin
 *
 * Copyright 2009 - 2010, Cake Development Corporation
 *                        1785 E. Sahara Avenue, Suite 490-423
 *                        Las Vegas, Nevada 89104
 *
 * Licensed under The LGPL License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright 2009 - 2010, Cake Development Corporation (http://cakedc.com)
 * @link      http://github.com/CakeDC/TinyMce
 * @package   TinyMce.Test.Case.View.Helper
 * @license   LGPL License (http://www.opensource.org/licenses/lgpl-2.1.php)
 */
App::uses('Controller', 'Controller');
App::uses('HtmlHelper', 'View/Helper');
App::uses('TinyMCEHelper', 'TinyMCE.View/Helper');

/**
 * TheTinyMceTestController class
 *
 * @package       TinyMce.Test.Case.View.Helper
 */
class TheTinyMCETestController extends Controller {

/**
 * name property
 *
 * @var string 'TheTest'
 */
	public $name = 'TheTest';

/**
 * uses property
 *
 * @var mixed null
 */
	public $uses = null;
}

/**
 * TheTinyMCETestView class
 *
 * @package       TinyMCE.Test.Case.View.Helper
 */
class TheTinyMCETestView extends View {
	public $_scripts = array();
}

/**
 * TinyMCEHelperTest class
 *
 * @package       TinyMCE.Test.Case.View.Helper
 */
class TinyMCETest extends CakeTestCase {

/**
 * Helper being tested
 *
 * @var object TinyMCEHelper
 * @access public
 */
	public $TinyMCE = null;

/**
 * @var array
 * @access public
 */
	public $configs = array(
		'simple' => array(
			'mode' => 'textareas',
			'theme' => 'simple',
			'editor_selector' => 'mceSimple'
		),
		'advanced' => array(
			'mode' => 'textareas',
			'theme' => 'advanced',
			'editor_selector' => 'mceAdvanced'
		)
	);

/**
 * startTest
 *
 * @return void
 * @access public
 */
	public function startTest() {
		Configure::write('Asset.timestamp', false);

		$this->View = new TheTinyMCETestView(null);
		$this->TinyMCE = new TinyMCEHelper($this->View);
		$this->TinyMCE->Html = new HtmlHelper($this->View);
		$this->TinyMCE->Html->request = new CakeRequest(null, false);
		$this->TinyMCE->Html->request->webroot = '';
	}

/**
 * endTest
 *
 * @return void
 * @access public
 */
	public function endTest() {
		unset($this->TinyMCE, $this->View);
	}

/**
 * testEditor
 *
 * @return void
 * @access public
 */
	public function testEditor() {
		$this->TinyMCE->editor(array('theme' => 'advanced'));
		$this->assertEqual($this->View->_scripts[0], '<script type="text/javascript">
//<![CDATA[
tinymce.init({
theme : "advanced"
});

//]]>
</script>');

		$this->TinyMCE->configs = $this->configs;
		$this->TinyMCE->editor('simple');
		$this->assertEqual($this->View->_scripts[1], '<script type="text/javascript">
//<![CDATA[
tinymce.init({
mode : "textareas",
theme : "simple",
editor_selector : "mceSimple"
});

//]]>
</script>');

		$this->expectException('OutOfBoundsException');
		$this->TinyMCE->editor('invalid-config');
	}

/**
 * testEditor with app wide options
 *
 * @return void
 * @access public
 */
	public function testEditorWithDefaults() {
		$this->assertTrue(Configure::write('TinyMCE.editorOptions', array('height' => '100px')));

		$this->TinyMCE->beforeRender();
		$this->TinyMCE->editor(array('theme' => 'advanced'));
		$this->assertEqual($this->View->_scripts[1], '<script type="text/javascript">
//<![CDATA[
tinymce.init({
height : "100px",
theme : "advanced"
});

//]]>
</script>');

		$this->TinyMCE->editor(array('height' => '50px'));
		$this->assertEqual($this->View->_scripts[2], '<script type="text/javascript">
//<![CDATA[
tinymce.init({
height : "50px"
});

//]]>
</script>');
	}

/**
 * testBeforeRender
 *
 * @return void
 * @access public
 */
	public function testBeforeRender() {
		$this->TinyMCE->beforeRender();
		$this->assertTrue(isset($this->View->_scripts[0]));
		$this->assertEqual($this->View->_scripts[0], '<script type="text/javascript" src="/TinyMCE/js/tiny_mce/tiny_mce.js"></script>');
	}

}
