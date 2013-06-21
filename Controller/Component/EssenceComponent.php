<?php

use fg\Essence\Essence;



/**
 *	A simple proxy to configure and use Essence.
 */

class EssenceComponent extends Component {

	/**
	 *	An array of providers to be used by Essence.
	 *
	 *	@var
	 */

	public $providers = array( );



	/**
	 *	The Essence instance.
	 *
	 *	@var fg\Essence\Essence
	 */

	protected $_Essence = null;



	/**
	 *	Initializes this component.
	 *
	 *	@param Controller $Controller Controller using this component.
	 */

	public function initialize( Controller $Controller ) {

		$this->_Essence = new Essence( $this->providers );
	}



	/**
	 *	A proxy to Essence methods.
	 *
	 *	@param string $name Name of the method to call.
	 *	@param array $arguments Arguments to pass to the method.
	 *	@return mixed The method return value.
	 */

	public function __call( $name, $arguments ) {

		if ( !method_exists( $this->_Essence, $name )) {
			throw new BadMethodCallException( 'This method doesn\'t exists.' );
		}

		return call_user_method_array( $name, $this->_Essence, $arguments );
	}
}
