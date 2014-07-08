Setup
=====

Be aware of short tags
----------------------

If your `php.ini` has short tags **enabled** you won't be able to load the asset files from the plugin because the Javascript contains a `<?` which the asset filter will interpret as php but fail to do so and your TinyMCE asset file will not be loaded.

An alternative is to copy or symlink the editor files to your applications webroot, which is the best way for performance reasons in any case.

Usage
-----

The TinyMCE helper is basically just a convenience helper that allows you to use php and CakePHP conventions to generate the configuration for TinyMCE and as an extra it allows you to load configs.

There two ways you can use this plugin, simply use the helper or load the editor "by hand" using

```php
$this->Html->script('/TinyMCE/js/tiny_mce/tiny_mce.js', array(
	'inline' => false
));
```

and placing your own script in the head of the page. Please note that the helper will auto add the TinyMCE editor script to the header of the page. No need to to that by hand if you use the helper.

If your app is not set up to work in the top level of your host / but instead in /yourapp/ the automatic inclusion of the script wont work. You'll manually have to add the js file to your app:

```php
$this->Html->script('/yourapp/TinyMCE/js/tiny_mce/tiny_mce.js', array(
	'inline' => false
));
```