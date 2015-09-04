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
	public function setUp() {
		Configure::write('Asset.timestamp', false);

		$this->View = new View(null);
		$this->TinyMCE = new TinyMCEHelper($this->View);
		$this->TinyMCE->Html = $this->getMock('HtmlHelper', array('script'), array($this->View));
	}

/**
 * endTest
 *
 * @return void
 * @access public
 */
	public function tearDown() {
		unset($this->TinyMCE, $this->View);
	}

/**
 * testEditor
 *
 * @return void
 * @access public
 */
	public function testEditor() {
		$this->TinyMCE->Html->expects($this->any())
			->method('scriptBlock')
			->with(
				'<script type="text/javascript">
				//<![CDATA[
				tinymce.init({
				theme : "advanced"
				});

				//]]>
				</script>',
				array('inline' => false));
		$this->TinyMCE->editor(array('theme' => 'advanced'));

		$this->TinyMCE->Html->expects($this->any())
			->method('scriptBlock')
			->with(
				'<script type="text/javascript">
				//<![CDATA[
				tinymce.init({
				mode : "textareas",
				theme : "simple",
				editor_selector : "mceSimple"
				});

				//]]>
				</script>',
				array('inline' => false));
		$this->TinyMCE->configs = $this->configs;
		$this->TinyMCE->editor('simple');

		$this->expectException('RuntimeException');
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

		$this->TinyMCE->Html->expects($this->any())
			->method('scriptBlock')
			->with(
				'<script type="text/javascript">
				//<![CDATA[
				tinymce.init({
				height : "100px",
				theme : "advanced"
				});

				//]]>
				</script>',
				array('inline' => false));
		$this->TinyMCE->beforeRender('test.ctp');
		$this->TinyMCE->editor(array('theme' => 'advanced'));

		$this->TinyMCE->Html->expects($this->any())
			->method('scriptBlock')
			->with(
				'<script type="text/javascript">
				//<![CDATA[
				tinymce.init({
				height : "50px"
				});

				//]]>
				</script>',
				array('inline' => false));
		$this->TinyMCE->editor(array('height' => '50px'));
	}

/**
 * testBeforeRender
 *
 * @return void
 * @access public
 */
	public function testBeforeRender() {
		$this->TinyMCE->Html->expects($this->any())
			->method('script')
			->with(
				'/TinyMCE/js/tiny_mce/tiny_mce.js',
				array('inline' => false));
		$this->TinyMCE->beforeRender('test.ctp');
	}

}
