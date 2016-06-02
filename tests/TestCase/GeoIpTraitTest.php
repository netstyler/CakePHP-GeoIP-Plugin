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
        $trait = new TestGeoIpTrait();

        // ipv4
        $result = $trait->getLocationFromIp('8.8.8.8');
        $this->assertInstanceOf('GeoIp2\Model\City', $result);
        $this->assertEquals('US', $result->country->isoCode);

        // ipv6
        $result = $trait->getLocationFromIp('2001:4860:4860::8888');
        $this->assertInstanceOf('GeoIp2\Model\City', $result);
        $this->assertEquals('US', $result->country->isoCode);
    }
}
