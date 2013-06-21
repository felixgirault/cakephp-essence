<?php

/**
 *	Essence bootstrapping.
 */

require_once dirname( __FILE__ )
	. DS . '..'
	. DS . 'Vendor'
	. DS . 'Essence'
	. DS . 'lib'
	. DS . 'bootstrap.php';

use fg\Essence\Utility\Registry;



/**
 *	Cache configuration.
 */

Cache::config(
	'essence',
	array(
		'engine' => 'File',
		'prefix' => 'essence_',
		'duration'=> 3600,
		'serialize' => true
	)
);



/**
 *
 */

App::uses( 'CakeCache', 'Essence.Lib' );
App::uses( 'CakeHttp', 'Essence.Lib' );
App::uses( 'HttpSocket', 'Network/Http' );

Registry::register( 'cache', new CakeCache( 'essence' ));
Registry::register( 'http', new CakeHttp( new HttpSocket( )));
