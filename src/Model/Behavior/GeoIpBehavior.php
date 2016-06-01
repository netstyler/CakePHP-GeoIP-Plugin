<?php
namespace Netstyler\GeoIp\Model\Behavior;

use Cake\ORM\Behavior;
use Netstyler\GeoIp\GeoIpTrait;

class GeoIpBehavior extends Behavior {

    use GeoIpTrait;

    /**
     * Container for data returned by the find method
     *
     * @var array
     * @access public
     */
    public $data = [];

    /**
     * ipLookup
     *
     * @param Model $Model
     * @param string $ipAddress The IP Address for which to find the location.
     * @return mixed Array of location data or null if no location found.
     * @access public
     */
    public function ipLookup($ipAddress) {
        $location = $this->getGeoIpInstance()->getLocationFromIp($ipAddress);

        if (!empty($location)) {
            return [
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
            ];
        }

        return $this->data;
    }

}
