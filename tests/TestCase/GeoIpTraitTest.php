<?php
namespace Netstyler\GeoIp\Test;

use Cake\TestSuite\TestCase;
use Netstyler\GeoIp\GeoIpTrait;

class TestGeoIpTrait {
    use GeoIpTrait;
}

/**
 * We're using the Google DNS Servers to test some real IPs
 * https://developers.google.com/speed/public-dns/docs/using
 */
class GeoIpTraitTest extends TestCase {

    public function testLookup()
    {
        clearstatcache();

        $trait = new TestGeoIpTrait();
        $result = $trait->getLocationFromIp('8.8.8.8');
        debug($result);

        // IPV6
        $result = $trait->getLocationFromIp('2001:4860:4860::8888');
        debug($result);

        $result = $trait->getLocationFromIp('invalid-ip');
        $this->assertFalse($result);
    }
}
