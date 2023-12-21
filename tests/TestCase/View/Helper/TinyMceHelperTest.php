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
namespace TinyMCE\Test\TestCase\View\Helper;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\TestSuite\TestCase;
use Cake\View\Helper\HtmlHelper;
use Cake\View\View;
use Exception;
use TinyMCE\View\Helper\TinyMCEHelper;

/**
 * TheTinyMceTestController class
 *
 * @package       TinyMce.Test.Case.View.Helper
 */
class TheTinyMCETestController extends Controller
{
    /**
     * name property
     *
     * @var string 'TheTest'
     */
    public string $name = 'TheTest';

    /**
     * uses property
     *
     * @var mixed null
     */
    public mixed $uses = null;
}

/**
 * TinyMCEHelperTest class
 */
class TinyMceHelperTest extends TestCase
{
    /**
     * Helper being tested
     */
    public ?TinyMCEHelper $TinyMCE = null;

    /**
     * @var array
     */
    public array $configs = [
        'modern' => [
            'selector' => 'textarea',
            'theme' => 'modern',
        ],
        'withoutPath' => [
            'selector' => 'textarea',
            'theme' => 'modern',
            'elementpath' => false,
        ],
    ];

    /**
     * startTest
     *
     * @return void
     */
    public function setUp(): void
    {
        Configure::write('Asset.timestamp', false);

        $this->View = new View(null);
        $this->TinyMCE = new TinyMCEHelper($this->View);
        $this->TinyMCE->Html = $this->getMockBuilder(HtmlHelper::class)
            ->setConstructorArgs([$this->View])
            ->onlyMethods(['scriptBlock', 'script'])
            ->getMock();
    }

    /**
     * endTest
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->TinyMCE, $this->View);
    }

    public function testEditorWithDefaultSettings(): void
    {
        $this->TinyMCE->Html->expects($this->once())
            ->method('scriptBlock')
            ->with(
                <<< TINYMCE
tinymce.init({
script : "https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js",
load_script : true,
theme : "modern"
});

TINYMCE,
                ['block' => true]
            );
        $this->TinyMCE->editor(['theme' => 'modern']);
    }

    public function testEditorWithCustomSettings(): void
    {
        $str = <<< TINYMCE
tinymce.init({
script : "https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js",
load_script : true,
selector : "textarea",
theme : "modern"
});

TINYMCE;

        $this->TinyMCE->Html->expects($this->once())
            ->method('scriptBlock')
            ->with(
                $str,
                ['block' => true]
            );
        $this->TinyMCE->configs = $this->configs;
        $this->TinyMCE->editor('modern');
    }

    public function testEditorWithInvalidSettings(): void
    {
        $this->expectException(Exception::class);
        $this->TinyMCE->editor('invalid-config');
    }

    public function testEditorWithConfiguration1(): void
    {
        $this->expectNotToPerformAssertions();
        Configure::write('TinyMCE.editorOptions', ['height' => '100px']);
        $this->TinyMCE->Html->expects($this->any())
            ->method('scriptBlock')
            ->with(
                <<< TINYMCE
tinymce.init({
height : "100px",
theme : "modern"
});

TINYMCE,
                ['block' => true]
            );
        $this->TinyMCE->beforeRender('test.ctp');
        $this->TinyMCE->editor(['theme' => 'modern']);
    }

    public function testEditorWithConfiguration2(): void
    {
        $this->expectNotToPerformAssertions();
        $this->TinyMCE->Html->expects($this->any())
            ->method('scriptBlock')
            ->with(
                <<< TINYMCE
tinymce.init({
script : "https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js",
load_script : true,
height : "50px"
});

TINYMCE,
                ['block' => true]
            );
        $this->TinyMCE->editor(['height' => '50px']);
    }

    /**
     * testBeforeRender
     *
     * @return void
     */
    public function testBeforeRender(): void
    {
        $this->expectNotToPerformAssertions();
        $this->TinyMCE->Html->expects($this->any())
            ->method('script')
            ->with(
                'https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js',
                ['block' => true, 'referrerpolicy' => true]
            );
        $this->TinyMCE->beforeRender('test.ctp');
    }
}
