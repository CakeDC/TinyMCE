<?php
declare(strict_types=1);

/**
 * Copyright 2013 - 2023, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2013 - 2023, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
namespace TinyMCE\View\Helper;

use Cake\Core\Configure;
use Cake\Utility\Inflector;
use Cake\View\Helper;
use Cake\View\View;
use Exception;
use function Cake\I18n\__;

/**
 * TinyMCE Helper
 *
 * @property \Cake\View\Helper\HtmlHelper $Html
 */
class TinyMCEHelper extends Helper
{
    /**
     * Other helpers used by FormHelper
     *
     * @var array<string>
     */
    public array $helpers = ['Html'];

    /**
     * Configuration
     *
     * @var array<string, mixed>
     */
    public array $configs = [];

    /**
     * Settings
     *
     * @var array<string, mixed>
     */
    public array $settings = [];

    /**
     * Default values
     *
     * @var array<string, mixed>
     */
    protected array $_defaultConfig = [
        'script' => 'https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js',
        'loadScript' => true,
    ];

    /**
     * Constructor
     *
     * @param \Cake\View\View $View The View this helper is being attached to.
     * @param array<string, mixed> $settings Configuration settings for the helper.
     */
    public function __construct(View $View, array $settings = [])
    {
        parent::__construct($View, $settings);
        $configs = Configure::read('TinyMCE.configs');
        if (!empty($configs) && is_array($configs)) {
            $this->configs = $configs;
        }
        $this->settings = array_merge(
            $this->_defaultConfig,
            empty($settings) ?
                Configure::read('TinyMCE.settings', []) :
                $settings
        );
    }

    /**
     * Adds a new editor to the script block in the head
     *
     * @see http://www.tinymce.com/wiki.php/Configuration for a list of keys
     * @throws \Exception
     * @param mixed $options If array camel cased TinyMCE Init config keys, if string it checks if a config with that name exists
     * @return void
     */
    public function editor(mixed $options = []): void
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
                if (is_string($value)) {
                    $value = '"' . $value . '"';
                } elseif (is_bool($value)) {
                    $value = $value ? 'true' : 'false';
                }
                $lines .= Inflector::underscore($option) . ' : ' . $value . ',' . "\n";
            }
        }

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
    public function beforeRender(string $viewFile): void
    {
        $appOptions = Configure::read('TinyMCE.editorOptions');
        if ($appOptions !== false && is_array($appOptions)) {
            $this->_defaultConfig = $appOptions;
        }
        if ($this->settings['loadScript'] === true) {
            $this->Html->script(
                $this->settings['script'],
                [
                    'block' => true,
                    'referrerpolicy' => 'origin',
                ]
            );
        }
    }
}
