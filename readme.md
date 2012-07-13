# TinyMCE Plugin for CakePHP #

The purpose of placing TinyMCE in a plugin is to keep it separate from a themed
view, the regular webroot or the app in general, which makes it easier to update
and overall follows the idea of keeping the code clean and modular.

To use TiniMCE you need to clone git repository in plugins/tiny_mce

The TinyMCE helper is basically just a convenience helper that allows you to use
php and CakePHP conventions to generate the configuration for TinyMCE and as an
extra it allows you to load configs.


There two ways you can use this plugin, simply use the helper or load the editor
"by hand" using 

	$this->Html->script('/tiny_mce/js/tiny_mce/tiny_mce.js', false);

and placing your own script in the head of the page. Please note that the helper
will auto add the TinyMCE editor script to the header of the page. No need to
to that by hand if you use the helper.

## How to use the helper ##

Whereever you want to use it, load it in the controller

	$this->helpers = array('TinyMce.TinyMce');


In the view simply use the editor() method and pass config key/value pairs in an
array.

	$this->TinyMce->editor(array(
		'theme' => 'advanced'));


You can find a list of possible configration keys for TinyMCE here
http://wiki.moxiecode.com/index.php/TinyMCE:Configuration for a list of keys

## Advanced usage of the helper ##

### Multiple configurations

The helper has a configs property which can be filled with data from database
or a config file. How you store, get and pass that data to the helper is up to
you. The configs property of the helper takes an array with named keys where 
the keys are used to load the configs.

Here is a basic example of configuration data:

	$configs = array(
		'simple' => array(
			'mode' => 'textareas',
			'theme' => 'simple',
			'editor_selector' => 'mceSimple'),
		'advanced' => array(
			'mode' => 'textareas',
			'theme' => 'advanced',
			'editor_selector' => 'mceAdvanced'));


When you loaded the configuration into the property you can simply use it by
calling the editor() method of the helper with a string that is equal to the key
of the configuration in the array:

	$this->TinyMce->editor(array(
		'theme' => 'advanced'));

### App wide default options

If you want a quick way to configure default values for all the TinyMCE Editors
of an application, you could use the 'TinyMCE.editorOptions' configuration.

Here is an example of a line you could have in `bootstrap.php`:

	Configure::write('TinyMCE.editorOptions', array('height' => '300px'))

It will make all editors to have a 300px height. You may want to override this
value for a single editor. To do so, just pass the option to the editor() method
and it will override the default value.


You can always check the tests to see how to use the helper.

## Requirements ##

* PHP version: PHP 5.2+
* CakePHP version: Cakephp 1.3 Stable

## Support ##

For support and feature request, please visit the [TinyMce Plugin Support Site](http://cakedc.lighthouseapp.com/projects/59619-tinymce-plugin/).

For more information about our Professional CakePHP Services please visit the [Cake Development Corporation website](http://cakedc.com).

## License ##

Copyright 2009-2010, [Cake Development Corporation](http://cakedc.com)

Licensed under [The GNU Lesser General Public License](http://www.gnu.org/licenses/lgpl.html)<br/>
Redistributions of files must retain the above copyright notice.

## Copyright ###

Copyright 2009-2010<br/>
[Cake Development Corporation](http://cakedc.com)<br/>
1785 E. Sahara Avenue, Suite 490-423<br/>
Las Vegas, Nevada 89104<br/>
http://cakedc.com<br/>
