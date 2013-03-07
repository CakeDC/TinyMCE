<?php
/**
 * Copyright 2009-2010, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The LGPL License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2009-2010, Cake Development Corporation (http://cakedc.com)
 * @license LGPL License (http://www.opensource.org/licenses/lgpl-2.1.php)
 */

/**
 * TinyMCE Helper
 *
 * @package TinyMCE
 * @subpackage TinyMCE.View.Helper
 */

class TinyMCEHelper extends AppHelper {

/**
 * Other helpers used by FormHelper
 *
 * @var array
 */
	public $helpers = array('Html');

/**
 * Configuration
 *
 * @var array
 */
	public $configs = array();

/**
 * Default values
 *
 * @var array
 */
	protected $_defaults = array();

/**
 * Constructor
 *
 * @param View $View The View this helper is being attached to.
 * @param array $settings Configuration settings for the helper.
 */
	public function __construct(View $View, $settings = array()) {
		parent::__construct($View, $settings);
		$configs = Configure::read('TinyMCE.configs');
		if (!empty($configs) && is_array($configs)) {
			$this->configs = $configs;
		}
	}

/**
 * Adds a new editor to the script block in the head
 *
 * @see http://www.tinymce.com/wiki.php/Configuration for a list of keys
 * @param mixed If array camel cased TinyMCE Init config keys, if string it checks if a config with that name exists
 * @return void
 */
	public function editor($options = array()) {
		if (is_string($options)) {
			if (isset($this->configs[$options])) {
				$options = $this->configs[$options];
			} else {
				throw new OutOfBoundsException(sprintf(__('Invalid TinyMCE configuration preset %s'), $options));
			}
		}
		$options = array_merge($this->_defaults, $options);
		$lines = '';

		foreach ($options as $option => $value) {
			$lines .= Inflector::underscore($option) . ' : "' . $value . '",' . "\n";
		}
		// remove last comma from lines to avoid the editor breaking in Internet Explorer
		$lines = rtrim($lines);
		$lines = rtrim($lines, ',');
		$this->Html->scriptBlock('tinymce.init({' . "\n" . $lines . "\n" . '});' . "\n", array('inline' => false));
	}

/**
 * beforeRender callback
 *
 * @return void
 */
	public function beforeRender($viewFile) {
		$appOptions = Configure::read('TinyMCE.editorOptions');
		if ($appOptions !== false && is_array($appOptions)) {
			$this->_defaults = $appOptions;
		}
		$this->Html->script('/TinyMCE/js/tiny_mce/tiny_mce.js', array('inline' => false));
	}
}
