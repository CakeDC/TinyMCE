<?php
namespace TinyMCE\View\Helper;

use Cake\Core\Configure;
use Cake\Utility\Inflector;
use Cake\View\Helper;
use Cake\View\View;
use Exception;

/**
 * Copyright 2009-2013, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2009-2013, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * TinyMCE Helper
 *
 * @package TinyMCE
 * @subpackage TinyMCE.View.Helper
 */
class TinyMCEHelper extends Helper
{

    /**
     * Other helpers used by FormHelper
     *
     * @var array
     */
    public $helpers = ['Html'];

    /**
     * Configuration
     *
     * @var array
     */
    public $configs = [];

    /**
     * Default values
     *
     * @var array
     */
    protected $_defaultConfig = [
        'script' => '/TinyMCE/js/tiny_mce4/tinymce.min.js',
        'loadScript' => true
    ];

    /**
     * Constructor
     *
     * @param View $View The View this helper is being attached to.
     * @param array $settings Configuration settings for the helper.
     */
    public function __construct(View $View, $settings = [])
    {
        parent::__construct($View, $settings);
        $configs = Configure::read('TinyMCE.configs');
        if (!empty($configs) && is_array($configs)) {
            $this->configs = $configs;
        }
        $this->settings = array_merge($this->_defaultConfig, $settings);
    }

    /**
     * Adds a new editor to the script block in the head
     *
     * @see http://www.tinymce.com/wiki.php/Configuration for a list of keys
     * @throws Exception
     * @param mixed If array camel cased TinyMCE Init config keys, if string it checks if a config with that name exists
     * @return void
     */
    public function editor($options = [])
    {
        if (is_string($options)) {
            if (isset($this->configs[$options])) {
                $options = $this->configs[$options];
            } else {
                throw new Exception(sprintf(__('Invalid TinyMCE configuration preset %s'), $options));
            }
        }
        $options = array_merge($this->_defaultConfig, $options);
        $lines = '';

        foreach ($options as $option => $value) {
            if (is_array($value) && isset($value['function'])) {
                $lines .= $option . ' : ' . $value['function'] . ',' . "\n";
            } else {
                $lines .= Inflector::underscore($option) . ' : "' . $value . '",' . "\n";
            }
        }

        // remove last comma from lines to avoid the editor breaking in Internet Explorer
        $lines = rtrim($lines);
        $lines = rtrim($lines, ',');
        $this->Html->scriptBlock('tinymce.init({' . "\n" . $lines . "\n" . '});' . "\n", ['block' => true]);
    }

    /**
     * beforeRender callback
     *
     * @param string $viewFile The view file that is going to be rendered
     * @return void
     */
    public function beforeRender($viewFile)
    {
        $appOptions = Configure::read('TinyMCE.editorOptions');
        if ($appOptions !== false && is_array($appOptions)) {
            $this->_defaultConfig = $appOptions;
        }
        if ($this->settings['loadScript'] === true) {
            $this->Html->script($this->settings['script'], ['block' => true]);
        }
    }

}
