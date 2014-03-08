Essence for CakePHP
===================

A plugin to use the [essence library](https://github.com/felixgirault/essence "Essence on github") within controllers.

Installation
------------

Just use composer from the app folder of your CakePHP installation:

```json
{
	"minimum-stability": "dev",
	"require": {
		"fg/cakephp-essence": "dev-master"
	},
	"config": {
		"vendor-dir": "Vendor"
	}
}

```

The plugin will be installed into `Plugins/`, thanks to composer's CakePHP installer, and the Essence library will be installed into `Vendor/`.

You should then load the plugin in `Config/bootstrap.php`:

```php
CakePlugin::load([
	'Essence' => [
		'bootstrap' => true
	]
]);
```

Component
---------

```php
class MyController extends AppController {

	public $components = [ 'Essence.Essence' ];
	
	
	
	/**
	 *	All methods of the Essence class are available through the Essence component.
	 *	
	 *	@see https://github.com/felixgirault/essence/blob/master/lib/fg/Essence/Essence.php
	 */
	 
	public function embed( $url ) {

		$this->set( 'media', $this->Essence->embed( $url ));
	}
}
```

Behavior
--------

```php
class MyModel extends AppModel {

	public $actsAs = [ 'Essence.Embeddable' ];
	
}
```
