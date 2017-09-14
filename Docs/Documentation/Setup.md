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
$this->TinyMCE->editor(['selector' => '#editor']);
```

View the examples

* [Examples](Examples.md)