<?php
namespace Netstyler\GeoIp\Test;

use Cake\TestSuite\TestCase;
use Netstyler\GeoIp\GeoIpTrait;
use GeoIp2\Database\Reader;

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


//    // This creates the Reader object, which should be reused across
//    // lookups.
//    $reader = new Reader(ROOT . DS . 'data' . DS . 'GeoLiteCity.dat');
//
//    // Replace "city" with the appropriate method for your database, e.g.,
//    // "country".
//    $record = $reader->city('128.101.101.101');
//
//    print($record->country->isoCode . "\n"); // 'US'
//    print($record->country->name . "\n"); // 'United States'
//    print($record->country->names['zh-CN'] . "\n"); // '美国'
//
//    print($record->mostSpecificSubdivision->name . "\n"); // 'Minnesota'
//    print($record->mostSpecificSubdivision->isoCode . "\n"); // 'MN'
//
//    print($record->city->name . "\n"); // 'Minneapolis'
//
//    print($record->postal->code . "\n"); // '55455'
//
//    print($record->location->latitude . "\n"); // 44.9733
//    print($record->location->longitude . "\n"); // -93.2323
//die();


        $trait = new TestGeoIpTrait();
        $result = $trait->getLocationFromIp('8.8.8.8');
        debug($result);

        // IPV6
        //fe80::be76:4eff:fe08:8a20/64
        //2a00:1a48:7807:103:be76:4eff:fe08:8a20
        $result = $trait->getLocationFromIp('2a00:1a48:7807:103:be76:4eff:fe08:8a20');
        debug($result);

        $result = $trait->getLocationFromIp('invalid-ip');
        $this->assertFalse($result);
    }
}
