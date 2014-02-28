<?php

/**
 *	Essence bootstrapping.
 */

use Essence\Di\Container;
use Essence\Cache\Engine\Cake as CakeCache;
use Essence\Http\Client\Cake as CakeHttpClient;

App::uses( 'HttpSocket', 'Network/Http' );



/**
 *	Cache configuration.
 */

Cache::config( 'essence', [
	'engine' => 'File',
	'prefix' => 'essence_',
	'duration'=> 3600,
	'serialize' => true
]);



/**
 *
 */

Configure::write( 'Essence.configuration', [
	'Cache' => Container::unique( function( ) {
		return new CakeCache( 'essence' );
	}),
	'Http' => Container::unique( function( ) {
		return new CakeHttpClient( new HttpSocket( ));
	})
]);
