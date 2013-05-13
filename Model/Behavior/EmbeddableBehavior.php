<?php

/**
 *	Allows a model to fetch data from remote providers.
 *
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@package Essence.Model.Behavior
 *	@license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

class EmbeddableBehavior extends ModelBehavior {

	/**
	 *	The Essence instance.
	 *
	 *	@var fg\Essence\Essence
	 */

	protected $_Essence = null;



	/**
	 *	Setup this behavior with the given configuration settings.
	 *
	 *	### Settings
	 *
	 *	- 'providers' - array - An array of providers to be used by Essence.
	 *		Defaults to an empty array, thus loading all available providers.
	 *	- 'urlField' - string - The name of the field which holds the URL of
	 *		the ressource to embed. Defaults to 'url'.
	 *	- 'mapping' - array|string -
	 *	- 'strict' - boolean - If strict mode is enabled, the data will not be
	 *		saved if the resource could not be embedded. Defaults to true.
	 *
	 *	@param Model $Model Model using this behavior.
	 *	@param array $config Configuration settings.
	 */

	public function setup( Model $Model, $settings = array( )) {

		$alias = $Model->alias;

		if ( !isset( $this->settings[ $alias ])) {
			$this->settings[ $alias ] = array(
				'providers' => array( ),
				'urlField' => 'url',
				'mapping' => 'auto',
				'strict' => true
			);
		}

		$this->settings[ $alias ] = array_merge(
			$this->settings[ $alias ],
			( array )$settings
		);

		$this->_Essence = new fg\Essence\Essence(
			$this->settings[ $alias ]['providers']
		);
	}



	/**
	 *	Tells if an URL points to an embeddable resource.
	 *
	 *	@param Model $Model Model using this behavior.
	 *	@param array $check The value to check.
	 *	@return boolean True if the URL points to an embeddable resource,
	 *		otherwise false.
	 */

	public function embeddable( Model $Model, $check ) {

		$url = array_shift( $check );
		$Media = $this->_Essence->embed( $url );

		return ( $Media !== null );
	}



	/**
	 *
	 *
	 *	@param Model $Model Model using this behavior.
	 */

	public function beforeSave( Model $Model ) {

		$alias = $Model->alias;
		extract( $this->settings[ $alias ]);

		if ( !empty( $Model->data[ $alias ][ $urlField ])) {
			$url = $Model->data[ $alias ][ $urlField ];
			$Media = $this->_Essence->embed( $url );

			if ( $Media ) {
				if ( !is_array( $mapping )) {
					$mapping = $this->_mappingFromSchema( $Model );
				}

				foreach ( $mapping as $property => $field ) {
					$value = $Media->property( $property );

					if ( $value ) {
						$Model->data[ $alias ][ $field ] = $value;
					}
				}

				return true;
			}
		}

		return $strict
			? false
			: true;
	}



	/**
	 *	Builds a default mapping from the table field names.
	 *
	 *	@param Model $Model Model using this behavior.
	 *	@return array The mapping.
	 */

	protected function _mappingFromSchema( Model $Model ) {

		$schema = $Model->schema( );
		$mapping = array( );

		if ( is_array( $schema )) {
			$fields = array_keys( $schema );
			$mapping = array_combine( $fields, $fields );
		}

		return $mapping;
	}
}
