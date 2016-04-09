<?php
namespace TinyMCE\Test\TestCase\View\Helper;

use Cake\Controller\Controller;
use Cake\TestSuite\TestCase;
use Cake\View\Helper\HtmlHelper;
use Cake\View\View;
use TinyMCE\View\Helper\TinyMCEHelper;

/**
 * CakePHP TinyMce Plugin
 *
 * Copyright 2009 - 2010, Cake Development Corporation
 *                        1785 E. Sahara Avenue, Suite 490-423
 *                        Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright 2009 - 2010, Cake Development Corporation (http://cakedc.com)
 * @link      http://github.com/CakeDC/TinyMce
 * @package   TinyMce.Test.Case.View.Helper
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

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
class TinyMCETest extends TestCase
{

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
    public $configs = [
        'modern' => [
            'selector' => 'textarea',
            'theme' => 'modern',
        ],
        'withoutPath' => [
            'selector' => 'textarea',
            'theme' => 'modern',
            'elementpath' => false
        ]
    ];

    /**
     * startTest
     *
     * @return void
     * @access public
     */
    public function setUp()
    {
        Configure::write('Asset.timestamp', false);

        $this->View = new View(null);
        $this->TinyMCE = new TinyMCEHelper($this->View);
        $this->TinyMCE->Html = $this->getMock('HtmlHelper', ['script'], [$this->View]);
    }

    /**
     * endTest
     *
     * @return void
     * @access public
     */
    public function tearDown()
    {
        unset($this->TinyMCE, $this->View);
    }

    /**
     * testEditor
     *
     * @return void
     * @access public
     */
    public function testEditor()
    {
        $this->TinyMCE->Html->expects($this->any())
            ->method('scriptBlock')
            ->with(
                '<script type="text/javascript">
                //<![CDATA[
                tinymce.init({
                theme : "modern"
                });

                //]]>
                </script>',
                ['inline' => false]);
        $this->TinyMCE->editor(['theme' => 'modern']);

        $this->TinyMCE->Html->expects($this->any())
            ->method('scriptBlock')
            ->with(
                '<script type="text/javascript">
                //<![CDATA[
                tinymce.init({
                selector : "textarea",
                theme : "modern"
                });

                //]]>
                </script>',
                ['block' => true]);
        $this->TinyMCE->configs = $this->configs;
        $this->TinyMCE->editor('modern');

        $this->expectException('RuntimeException');
        $this->TinyMCE->editor('invalid-config');
    }

    /**
     * testEditor with app wide options
     *
     * @return void
     * @access public
     */
    public function testEditorWithDefaults()
    {
        $this->assertTrue(Configure::write('TinyMCE.editorOptions', ['height' => '100px']));

        $this->TinyMCE->Html->expects($this->any())
            ->method('scriptBlock')
            ->with(
                '<script type="text/javascript">
                //<![CDATA[
                tinymce.init({
                height : "100px",
                theme : "modern"
                });

                //]]>
                </script>',
                ['block' => true]);
        $this->TinyMCE->beforeRender('test.ctp');
        $this->TinyMCE->editor(['theme' => 'modern']);

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
                ['block' => true]);
        $this->TinyMCE->editor(['height' => '50px']);
    }

    /**
     * testBeforeRender
     *
     * @return void
     * @access public
     */
    public function testBeforeRender()
    {
        $this->TinyMCE->Html->expects($this->any())
            ->method('script')
            ->with(
                '/TinyMCE/js/tiny_mce4/tinymce.min.js',
                ['block' => true]);
        $this->TinyMCE->beforeRender('test.ctp');
    }

}
