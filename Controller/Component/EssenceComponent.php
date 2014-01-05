<?php

use Essence\Essence;



/**
 *	A simple proxy to configure and use Essence.
 */

class EssenceComponent extends Component {

	/**
	 *	A proxy to Essence methods.
	 *
	 *	@param string $name Name of the method to call.
	 *	@param array $arguments Arguments to pass to the method.
	 *	@return mixed The method return value.
	 */

	public function __call( $name, $arguments ) {

		if ( !method_exists( 'Essence', $name )) {
			throw new BadMethodCallException( 'This method doesn\'t exists.' );
		}

		static $Essence = null;

		if ( $Essence === null ) {
			$Essence = Essence::instance( Configure::read( 'Essence.configuration' ));
		}

		return call_user_func_array( array( $Essence, $name ), $arguments );
	}
}
