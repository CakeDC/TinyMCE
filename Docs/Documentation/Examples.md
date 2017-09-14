## How to use the helper ##

* Load it in the AppView for use helper where you want.


```
/src/View/AppView.php

    public function initialize()
    {
        $this->loadHelper('TinyMCE.TinyMCE');
    }
```

At the view's top where you want to use it, simply add the editor() method and pass config key/value pairs in an array.

```php
$this->TinyMCE->editor(['theme' => 'modern', 'selector' => 'textarea']);
```

This will instruct TinyMCE to convert all `textarea` elements on the page to TinyMCE editors. If you require some more precise control, or want to change this behavior, checkout the [TinyMCE configuration options](http://www.tinymce.com/wiki.php/Configuration) on the TinyMCE website.

* You can use CSS selectors for specific textarea **id** like this: 

```php
$this->TinyMCE->editor(['theme' => 'modern', 'selector' => '#editor']);
```

You need to add the jQuery file to make it work the helper.

```php
echo $this->Html->script('//code.jquery.com/jquery-3.2.1.min.js', 'block' => true);
```


Application wide default options
--------------------------------

The helper has a configs property which can be filled with data from database or a config file. How you store, get and pass that data to the helper is up to you. The configs property of the helper takes an array with named keys where the keys are used to load the configs.

* If you want use your own config file load the plugin with bootstrap **false**

```
Plugin::load('TinyMCE', ['routes' => false, 'bootstrap' => false]);

```
* Copy the config file of the plugin in your config folder for the initial configurations for the all editors


```
/vendor/cakedc/tiny-mce/config/tiny_mce.php

return [
    'TinyMCE' => [
        ......
        ],
    ]
];

```

* In bootstrap.php file of your application, load your config file


```
/config/bootstrap.php

Configure::load('tiny_mce', 'default');
```
