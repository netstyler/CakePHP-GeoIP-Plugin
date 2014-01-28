<?php
App::uses('GeoIp', 'ModelBehavior');
include(CakePlugin::path('GeoIp') . 'Vendor' . DS . 'GeoIP' . DS . 'GeoIP.php');

class GeoIpBehavior extends ModelBehavior {

/**
 * Container for data returned by the find method
 *
 * @var array
 * @access public
 */
	public $data = array();

/**
 * ipLookup
 *
 * @param Model $Model
 * @param string $ipAddress The IP Address for which to find the location.
 * @return mixed Array of location data or null if no location found.
 * @access public
 */
	public function ipLookup(Model $Model, $ipAddress) {
		$GeoIp = $this->getGeoIpInstance($Model);
		try {
			$location = $GeoIp->lookupLocation($ipAddress);
			if (!empty($location)) {
				$this->data = array($Model->name => array(
					'country_code' => $location->countryCode,
					'country_code_3' => $location->countryCode3,
					'country_name' => $location->countryName,
					'region' => $location->region,
					'city' => $location->city,
					'postal_code' => $location->postalCode,
					'latitude' => $location->latitude,
					'longitude' => $location->longitude,
					'area_code' => $location->areaCode,
					'dma_code' => $location->dmaCode
				));
			}
		} catch (Exception $e) {
			echo $e->getMessage();
			return null;
		}
		return $this->data;
	}

/**
 * Get a Net_GeoIP instance and loads the dat file.
 *
 * @throws RunTimeException
 * @param Model $Model
 * @param string $dataFile
 * @return Net_GeoIP
 */
	public function getGeoIpInstance(Model $Model, $dataFile = null) {
		if (empty($dataFile)) {
			$dataFile = Configure::read('GeoIp.dataFile');
			if (empty($dataFile)) {
				$dataFile = CakePlugin::path('GeoIp') . 'data' . DS . 'GeoIP.dat';
			}
		}
		if (!file_exists($dataFile)) {
			throw new RunTimeException(__d('geo_ip', 'Failed to load geo ip data file %s!', $dataFile));
		}
		return Net_GeoIP::getInstance($dataFile);
	}

}
