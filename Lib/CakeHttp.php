<?php

App::uses( 'HttpSocket', 'Network/Http' );



/**
 *	Handles HTTP related operations.
 */

class CakeHttp implements fg\Essence\Http {

	/**
	 *	The HttpSocket.
	 *
	 *	@var HttpSocket
	 */

	protected $_Socket = null;



	/**
	 *	Sets the socket to use.
	 *
	 *	@param HttpSocket $Socket Socket.
	 */

	public function __construct( HttpSocket $Socket ) {

		$this->_Socket = $Socket;
	}



	/**
	 *	Retrieves contents from the given URL.
	 *
	 *	@param string $url The URL fo fetch contents from.
	 *	@return string The fetched contents.
	 *	@throws \fg\Essence\Http\Exception
	 */

	public function get( $url ) {

		$Response = $this->_Socket->get( $url );

		if ( !$Response->isOk( )) {
			// let's assume the file doesn't exists
			throw new Exception( $Response->code, $url );
		}

		return $Response->body( );
	}
}
