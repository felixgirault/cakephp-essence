<?php

use fg\Essence\Essence;



/**
 *
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

		$this->_Essence = new Essence( $this->providers );
	}



	/**
	 *
	 */

	public function __call( $name, $arguments ) {

		if ( method_exists( $this->_Essence, $name )) {
			return call_user_method_array( $name, $this->_Essence, $arguments );
		}
	}



	/**
	 *
	 */

	public function extract( $url ) {

		$key = 'extract_' . md5( $url );
		$cached = Cache::read( $key, false );

		if ( $cached !== false ) {
			return $cached;
		}

		$urls = $this->_Essence->extract( $url );
		Cache::write( $key, $urls, 'essence' );

		return $urls;
	}



	/**
	 *
	 */

	public function embed( $url, array $options = array( )) {

		$key = 'embed_' . md5( $url ) . '_' . md5( serialize( $options ));
		$cached = Cache::read( $key, false, 'essence' );

		if ( $cached !== false ) {
			return $cached;
		}

		$Media = $this->_Essence->embed( $url, $options );
		Cache::write( $key, $Media, 'essence' );

		return $Media;
	}



	/**
	 *
	 */

	public function embedAll( $urls, array $options = array( )) {

		$key = 'embed_all_' . md5( serialize( $urls ))
			. '_' . md5( serialize( $options ));

		$cached = Cache::read( $key, false, 'essence' );

		if ( $cached !== false ) {
			return $cached;
		}

		$medias = $this->_Essence->embedAll( $urls, $options );
		Cache::write( $key, $medias, 'essence' );

		return $medias;
	}
}
