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



/**
 *
 */

App::uses( 'CakeHttp', 'Essence.Lib' );
App::uses( 'HttpSocket', 'Network/Http' );

fg\Essence\Registry::register( 'http', new CakeHttp( new HttpSocket( )));



/**
 *	Cache configuration.
 */

Cache::config(
	'essence',
	array(
		'engine' => 'File',
		'duration'=> 3600,
		'prefix' => 'essence_',
		'serialize' => true
	)
);
