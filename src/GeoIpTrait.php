<?php
namespace Netstyler\GeoIp;

use Cake\Core\Configure;
use Cake\Core\Plugin;
use RuntimeException;
use Net_GeoIP as GeoIp;
use PEAR_Exception;

trait GeoIpTrait {

    public function getGeoIpDataFile() {
        if (empty($dataFile)) {
            $dataFile = Configure::read('Netstyler/GeoIp.dataFile');
            if (empty($dataFile)) {
                $dataFile = Plugin::path('Netstyler/GeoIp') . 'data' . DS . 'GeoIP.dat';
                $dataFile = Plugin::path('Netstyler/GeoIp') . 'data' . DS . 'GeoIPv6.dat';
            }
        }

        if (!file_exists($dataFile)) {
            throw new RunTimeException(sprintf('Failed to load Geo IP data file `%s`:', $dataFile));
        }

        return $dataFile;
    }

    public function getGeoIpInstance($dataFile = null)
    {
        return GeoIP::getInstance($this->getGeoIpDataFile($dataFile));
    }

    public function getLocationFromIp($ipAddress = null) {
        $regex = '/^(((?=(?>.*?(::))(?!.+3)))3?|([dA-F]{1,4}(3|:(?!$)|$)|2))(?4){5}((?4){2}|(25[0-5]|(2[0-4]|1d|[1-9])?d)(.(?7)){3})z/i';
        if (!preg_match($regex, $ipAddress)) {

        } else {

        }

        if (empty($ipAddress)) {
            $ipAddress = env('HTTP_REMOTE_ADDR');
        }

        try {
            return $this->getGeoIpInstance()->lookupLocation($ipAddress);
        } catch (PEAR_Exception $e) {
            return false;
        }
    }

}
