<?php
/**
 * GeoIP Location
 *
 * Model class for finding a location based on an IP Address using the MaxMind
 * GeoIP database and the PEAR Net_GeoIP package.
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to the MIT License that is available
 * through the world-wide-web at the following URI:
 * http://www.opensource.org/licenses/mit-license.php.
 *
 * @author	 Robert Love <robert@pollenizer.com>
 * @copyright  Copyright 2011, Pollenizer (http://pollenizer.com/)
 * @license	MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @version	1.0
 * @since	  File available since Release 2.0
 * @see		http://www.maxmind.com/app/ip-location
 * @see		http://pear.php.net/package/Net_GeoIP/
 * @see		http://pear.php.net/manual/en/package.networking.net-geoip.lookuplocation.php
 */

/**
 * Include PEAR Net_GeoIP class
 */
App::import('GeoIp.Lib', 'GeoIP');

/**
 * GeoIP Location class
 */
class GeoIpLocation extends AppModel {

/**
 * Behaviors
 *
 * @var array
 */
	public $actsAs = array(
		'GeoIp.GeoIp'
	);

/**
 * The name of the model
 *
 * @var string
 * @access public
 */
	public $name = 'GeoIpLocation';

	public function find($type = 'first', $query = array()) {
		$this->ipLookup($type);
	}

}
