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

Plugin::load('TinyMCE');

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

To retreive the latest updates to the plugin, assuming you're using the "master" branch, go to "app/Plugin/TinyMCE" and run the following command:

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
            "url": "git@github.com:**Your-User**/TinyMCE.git"
        }
    ],
```