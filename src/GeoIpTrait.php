<?php
namespace Netstyler\GeoIp;

trait GeoIpTrait {

    /**
     * Get the location based on the given ip address.
     *
     * @param string $ipAddress An ipv4 or ipv6 address.
     * @param array $options Options to configure the GeoIp instance.
     */
    public function getLocationFromIp($ipAddress = null, array $options = [])
    {
        $geoIp = new GeoIp($options);
        return $geoIp->lookup($ipAddress);
    }
}
