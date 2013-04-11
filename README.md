Essence for CakePHP
===================

A plugin to use the [essence](https://github.com/felixgirault/essence "Essence on github") library within controllers.

Installation
------------

Just clone this repo into the Plugin/Essence directory of your application.
Then run these commands to retrieve the essence library:

```
git submodule init
git submodule update
```

Configuration
-------------

Attach the Essence component to your controller:

```php
<?php

class MyController extends AppController {

	public $components = array(
		'Essence.Essence' => array(
			'providers' => array(
				'OEmbed/Dailymotion',
				'OEmbed/Vimeo',
				'OEmbed/Youtube',
				'OpenGraph/Ted'
			)
		)
	);

	// ...
}

?>
```

Usage
-----

All methods of [the Essence class](https://github.com/felixgirault/essence/blob/master/lib/fg/Essence/Essence.php "Essence class source") are available through the Essence component:

```php
<?php

public function embed( $url ) {

	$this->set( 'media', $this->Essence->embed( $url ));
}

?>
```
