<?php

/**
 *	Essence bootstrapping.
 */

require_once dirname( dirname( __FILE__ )) . DS . 'Vendor' . DS . 'autoload.php';

use Essence\Di\Container;
use Essence\Cache\Engine\Cake as CakeCache;
use Essence\Http\Client\Cake as CakeHttpClient;

App::uses( 'HttpSocket', 'Network/Http' );



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

Configure::write( 'Essence.configuration', array(
	'Cache' => Container::unique( function( ) {
		return new CakeCache( 'essence' );
	}),
	'Http' => Container::unique( function( ) {
		return new CakeHttpClient( new HttpSocket( ));
	})
));
