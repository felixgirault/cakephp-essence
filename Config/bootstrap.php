<?php

/**
 *	Essence bootstrapping.
 */

use Essence\Di\Container;
use Essence\Cache\Engine\Cake as CacheInterface;
use Essence\Http\Client\Cake as HttpInterface;
use Essence\Log\Logger\Cake as LogInterface;

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
 *	Dependency injection configuration.
 */

Configure::write( 'Essence.configuration', [
	'Cache' => Container::unique( function( ) {
		return new CacheInterface( 'essence' );
	}),
	'Http' => Container::unique( function( ) {
		return new HttpInterface( new HttpSocket( ));
	}),
	'Log' => Container::unique( function( ) {
		return new LogInterface( 'essence' );
	})
]);
