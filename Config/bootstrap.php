<?php

/**
 *	Essence bootstrapping.
 */

use Essence\Di\Container;
use Essence\Cache\Engine\Cake as CacheInterface;
use Essence\Http\Client\Cake as HttpInterface;

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
		return new CacheInterface( 'essence' );
	}),
	'Http' => Container::unique( function( ) {
		return new HttpInterface( new HttpSocket( ));
	})
]);
