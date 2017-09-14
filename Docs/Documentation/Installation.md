Installation
============

To install the plugin use composer.

Composer
--------

Last release for CakePHP 3.x

```
composer require cakedc/tiny-mce 2.0.0
```

If you want to use the branch of developer for CakePHP 3.x

```
composer require cakedc/tiny-mce 3.x-dev
```



Load the plugin in your bootstrap file

```
//config/bootstrap.php

Plugin::load('TinyMCE', ['routes' => false, 'bootstrap' => true]);

```

Load the Helper of plugin in yor App View

```
//src/View/AppView.php
 public function initialize()
    {
        parent::initialize();

        $this->loadHelper('TinyMCE.TinyMCE');
    }
```

To retreive the latest updates to the plugin run the following command:

* In the composer.json of yor App you can see the branch where are you updating:

```
"require": {
        "cakedc/tiny-mce": "3.x-dev" // or 2.0.0-dev
    }
```

```
composer update
```

Fork
--------

If you want to contribute with the plugin fork the repository and changes your composer.json
of you application with this.

```
"repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:YOUR-USER-NAME/TinyMCE.git"
        }
    ],
```