<?php
class TinymceHelper extends AppHelper {

/**
 * Other helpers used by FormHelper
 *
 * @var array
 * @access public
 */
	public $helpers = array('Javascript', 'Html');

/**
 * 
 *
 * @var array
 * @access public
 */
	public $configs = array();

/**
 * 
 *
 * @var string
 * @access protected
 */
	protected $_editors = '';

/**
 * 
 *
 * @var array
 * @access protected
 */
	protected $_defaults = array();

/**
 * Adds a new editor to the script block in the head
 *
 * @param mixed If array TinyMce Init config keys, if string it checks if a config with that name exists
 * @return void
 * @access public
 */
	public function editor($options = array()) {
		if (is_string($options) && isset($this->configs[$options])) {
			$options = $this->configs[$options];
		}

		$options = array_merge($this->_defaults, $options);

		$lines = '';
		foreach ($options as $option => $value) {
			$lines .= Inflector::underscore($option) . ' : "' . $value . '",' . "\n";
		}
		$this->_editors .= 'tinyMCE.init({' . "\n" . $lines . '});' . "\n";
	}

/**
 * 
 */
	public function beforeRender() {
		$this->Html->script('/tiny_mce/js/tiny_mce/tiny_mce.js', false);
		$this->Javascript->codeBlock($this->_editors, array(
			'inline' => true));
	}

}
?>