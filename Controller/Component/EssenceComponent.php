<?php

/**
 *	A simple wrapper to configure and use Essence.
 */

class EssenceComponent extends Component {

	/**
	 *
	 */

	public $providers = array( );



	/**
	 *
	 */

	protected $_Essence = null;



	/**
	 *
	 */

	public function initialize( Controller $Controller ) {

		$this->_Essence = new fg\Essence\Essence( $this->providers );
	}



	/**
	 *
	 */

	public function __call( $name, $arguments ) {

		if ( method_exists( $this->_Essence, $name )) {
			return call_user_method_array( $name, $this->_Essence, $arguments );
		}
	}
}
