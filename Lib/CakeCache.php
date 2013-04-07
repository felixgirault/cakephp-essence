<?php

App::uses( 'Cache', 'Cache' );



/**
 *	Handles caching.
 */

class CakeCache implements fg\Essence\Cache {

	/**
	 *	The cache config.
	 *
	 *	@var string
	 */

	protected $_config = '';



	/**
	 *	Sets the config to use.
	 *
	 *	@param string $config Config.
	 */

	public function __construct( $config = 'default' ) {

		$this->_config = $config;
	}



	/**
	 *	Returns if data exists for the given key.
	 *
	 *	@param string $key The key to test.
	 *	@return boolean Whether there is data for the key or not.
	 */

	public function has( $key ) {

		return ( Cache::read( $key, $this->_config ) !== false );
	}



	/**
	 *	Returns the data for the given key.
	 *
	 *	@param string $key The key to search for.
	 *	@param mixed $default Default value to return if there is no data.
	 *	@return mixed The data.
	 */

	public function get( $key, $default = null ) {

		$data = Cache::read( $key, $this->_config );

		return ( $data === false )
			? $default
			: $data;
	}



	/**
	 *	Sets the data for the given key.
	 *
	 *	@param string $key The key for the data.
	 *	@param mixed $data The data.
	 */

	public function set( $key, $data ) {

		Cache::write( $key, $data, $this->_config );
	}



	/**
	 *	Deletes all cached data.
	 */

	public function clear( ) {

		Cache::clear( false, $this->_config );
	}
}
