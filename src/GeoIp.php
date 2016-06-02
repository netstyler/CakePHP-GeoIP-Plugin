<?php
namespace Netstyler\GeoIp;

use Cake\Core\Configure;
use Cake\Network\Request;
use GeoIp2\Database\Reader;

class GeoIp {

    /**
     * Configuration
     *
     * @var array
     */
    protected $_config = [];

    /**
     * GeoIp Reader instance.
     *
     * @var \GeoIp2\Database\Reader
     */
    protected $_geoIp;

    /**
     *
     */
    public function __construct(array $config = [])
    {
        $defaults = (array)Configure::read('GeoIp');
        $config = array_merge($defaults, $config);
        $this->_validateConfig($config);
        $this->_config = $config;
        $this->_geoIp = $this->getGeoIpInstance($config['dataFile']);
    }

    /**
     * Get an new GeoIP read instance.
     *
     * @param string $dataFile MaxMind GeoIP Database file.
     * @return \GeoIp2\Database\Reader
     */
    public function getGeoIpInstance($dataFile)
    {
        return new Reader($dataFile);
    }

    /**
     * Get the location based on the given ip address.
     *
     * @param string|\Cake\Network\Request $ipAddress An ipv4 or ipv6 address.
     */
    public function lookup($ipAddress)
    {
        if (empty($ipAddress)) {
            $ipAddress = env('HTTP_REMOTE_ADDR');
        }
        if ($ipAddress instanceof Request) {
            $ipAddress = $ipAddress->clientIp();
        }

        return $this->_geoIp->{$this->_config['dataType']}($ipAddress);
    }

    /**
     * Checks the configuration data.
     *
     * @return void
     */
    protected function _validateConfig($options)
    {
        if (!isset($options['dataFile'])) {
            throw new RuntimeException('GeoIp database file is not');
        }

        if (empty($options['dataType'])) {
            throw new RuntimeException('GeoIp data type is not specified. Must be city or country.');
        }

        if (!in_array($options['dataType'], ['city', 'country'])) {
            throw new RuntimeException(sprintf('Invalid data type `%s`! Must be city or country.', $options['dataType']));
        }
    }
}
