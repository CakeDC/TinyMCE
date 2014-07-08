## How to use the helper ##

Wherever you want to use it, load it in the controller

```php
$this->helpers = array('TinyMCE.TinyMCE');
```

In the view simply use the editor() method and pass config key/value pairs in an array.

```php
$this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));
```

This will instruct TinyMCE to convert all `textarea` elements on the page to TinyMCE editors. If you require some more precise control, or want to change this behavior, checkout the [TinyMCE configuration options](http://www.tinymce.com/wiki.php/Configuration) on the TinyMCE website.

Multiple configurations
-----------------------

The helper has a configs property which can be filled with data from database or a config file. How you store, get and pass that data to the helper is up to you. The configs property of the helper takes an array with named keys where the keys are used to load the configs.

Here is a basic example of configuration data:

```php
$configs = array(
	'simple' => array(
		'mode' => 'textareas',
		'theme' => 'simple',
		'editor_selector' => 'mceSimple'
	),
	'advanced' => array(
		'mode' => 'textareas',
		'theme' => 'advanced',
		'editor_selector' => 'mceAdvanced'
	)
);

$this->TinyMCE->configs = $configs;
```

You can also put the configuration in APP/config/bootstap.php or another config file and load it. Inside the config file you have you can write the config as above to the TinyMce configuration:

```php
Configure::write('TinyMCE.configs', array(
	'simple' => ...,
	'advanced' => ...));
```

The different sets of configuration data will be auto loaded by the helper inside its constructor. It is suggested that you use this way of passing different configs to the helper because by this you'll be able to store all of them in one place.

When you passed the configuration to the helper you can simply use it by calling the editor() method of the helper with a string that is equal to the key of the configuration in the array:

```php
$this->TinyMCE->editor('simple'); // This matches the 'simple' config name we passed in earlier.
```

Application wide default options
--------------------------------

If you want a quick way to configure default values for all the TinyMCE Editors of an application, you could use the 'TinyMCE.editorOptions' configuration.

Here is an example of a line you could have in `bootstrap.php`:

```php
Configure::write('TinyMCE.editorOptions', array('height' => '300px'))
```

It will make all editors to have a 300px height. You may want to override this value for a single editor. To do so, just pass the option to the editor() method and it will override the default value.

You can always check the tests to see how to use the helper.