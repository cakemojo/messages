# CakeMojo/Messages plugin for CakePHP

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require CakeMojo/Messages
```

Creating Required Tables
------------------------
If you want to use the provided Messages table:

```
bin/cake migrations migrate -p CakeMojo/Messages
```

Load the Plugin
-----------

Ensure the plugin is loaded in your config/bootstrap.php file

```
Plugin::load('CakeMojo/Messages', ['routes' => true, 'bootstrap' => false]);
```
