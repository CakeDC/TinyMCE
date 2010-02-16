<?php
App::import('Helper', array('Html', 'TinyMce.TinyMce'));

class TinyMceTestCase extends CakeTestCase {

/**
 * Helper being tested
 *
 * @var object TinyMceHelper
 */
	public $Rating;

/**
 * (non-PHPdoc)
 * @see cake/tests/lib/CakeTestCase#startTest($method)
 */
	public function startTest() {
		$this->TinyMce = new TinyMceHelper();
	}

/**
 * (non-PHPdoc)
 * @see cake/tests/lib/CakeTestCase#endTest($method)
 */
	public function endTest() {
		unset($this->TinyMce);
		ClassRegistry::flush();
	}

/**
 * @return void
 * @access public
 */
	public function testEditor() {
		$this->TinyMce->editor();
	}

}
?>