Copyright 2009 - 2010, Cake Development Corporation
                        1785 E. Sahara Avenue, Suite 490-423
                        Las Vegas, Nevada 89104
                        http://cakedc.com

TinyMCE Plugin

The purpose of placing TinyMCE in a plugin is to keep it separate from a themed
view, the regular webroot or the app in general, which makes it easier to update
and overall follows the idea of keeping the code clean and modular.

The TinyMCE helper is basically just a convenience helper that allows you to use
php and CakePHP conventions to generate the configuration for TinyMCE and as an
extra it allows you to load configs.


There two ways you can use this plugin, simply use the helper or load the editor
"by hand" using 
{{{
	$this->Html->script('/tiny_mce/js/tiny_mce/tiny_mce.js', false);
}}}
and placing your own script in the head of the page. Please note that the helper
will auto add the TinyMCE editor script to the header of the page. No need to
to that by hand if you use the helper.

== How to use the helper ==

Whereever you want to use it, load it in the controller
{{{
	$this->helpers = array('TinyMce.TinyMce');
}}}

In the view simply use the editor() method and pass config key/value pairs in an
array.
{{{
	$this->TinyMce->editor(array(
		'theme' => 'advanced'));
}}}

You can find a list of possible configration keys for TinyMCE here
http://wiki.moxiecode.com/index.php/TinyMCE:Configuration for a list of keys

== Advanced usage of the helper ==

The helper has a configs property which can be filled with data from database
or a config file. How you store, get and pass that data to the helper is up to
you. The configs property of the helper takes an array with named keys where 
the keys are used to load the configs.

Here is a basic example of configuration data:
{{{
	$configs = array(
		'simple' => array(
			'mode' => 'textareas',
			'theme' => 'simple',
			'editor_selector' => 'mceSimple'),
		'advanced' => array(
			'mode' => 'textareas',
			'theme' => 'advanced',
			'editor_selector' => 'mceAdvanced'));
}}}

When you loaded the configuration into the property you can simply use it by
calling the editor() method of the helper with a string that is equal to the key
of the configuration in the array:
{{{
	$this->TinyMce->editor(array(
		'theme' => 'advanced'));
}}

You can always check the tests to see how to use the helper.