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
