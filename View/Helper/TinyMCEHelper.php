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
 * No editor class holder
 *
 * @var string
 */
	protected $_noEditorClass = 'mceNoEditor';

/**
 * Constructor
 *
 * @param View $View The View this helper is being attached to.
 * @param array $settings Configuration settings for the helper.
 */
	public function __construct(View $View, $settings = array()) {
		parent::__construct($View, $settings);
		$configs = Configure::read('Plugins.TinyMCE.configs');
		if (!empty($configs) && is_array($configs)) {
			$this->configs = $configs;
		}

		// Add no editor class to defaults
		$this->noEditorClass($this->_noEditorClass);
	}

/**
 * Adds a new editor to the script block in the head
 *
 * @see http://www.tinymce.com/wiki.php/Configuration for a list of keys
 * @param mixed If array camel cased TinyMCE Init config keys, if string it checks if a config with that name exists
 * @param boolean $scriptBlock Whether or not the result of this method is put in a scriptBlock
 * @param boolean $inline Whether or not the scriptBlock should be inline or not
 * @return void
 */
	public function editor($options = array(), $scriptBlock = true, $inline = false) {
		if (is_string($options)) {
			if (isset($this->configs[$options])) {
				$options = $this->configs[$options];
			} else {
				throw new OutOfBoundsException(sprintf(__('Invalid TinyMCE configuration preset %s'), $options));
			}
		} elseif (isset($options['config'])) {
			if (isset($this->configs[$options['config']])) {
				$options = array_merge_recursive($this->configs[$options['config']], $options);
			} else {
				throw new OutOfBoundsException(sprintf(__('Invalid TinyMCE configuration preset %s'), $options['config']));
			}
			unset($options['config']);
		}
		$options = array_merge($this->_defaults, $options);
		$lines = '';

		foreach ($options as $option => $value) {
			$lines .= Inflector::underscore($option) . ' : "' . $value . '",' . "\n";
		}
		// remove last comma from lines to avoid the editor breaking in Internet Explorer
		$lines = rtrim($lines);
		$lines = rtrim($lines, ',');
		$result = 'tinymce.init({' . "\n" . $lines . "\n" . '});' . "\n";
		if($scriptBlock){
			return $this->Html->scriptBlock($result, array('inline' => $inline));
		}
		else{
			return $result;
		}
	}

/**
 * beforeRender callback
 *
 * @return void
 */
	public function beforeRender($viewFile) {
		$appOptions = Configure::read('Plugins.TinyMCE.editorOptions');
		if ($appOptions !== false && is_array($appOptions)) {
			$this->_defaults = $appOptions;
		}
		$this->Html->script('/TinyMCE/js/tiny_mce/tiny_mce.js', array('inline' => false));
	}

/**
 * Setter/Getter for no editor class.
 * Be carefull when using regex here. You can not use it a class getter then.
 *
 * @param string $class The class to use.
 * @return string
 */
	public function noEditorClass($class = null){
		if(!empty($class)){
			$this->_noEditorClass = $class;
			$this->_defaults['editor_deselector'] = $this->_noEditorClass;
		}
		return $this->_noEditorClass;
	}

}
