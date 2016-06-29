<?php
namespace Netstyler\GeoIp;

use Cake\Core\Configure;
use Cake\Network\Request;
use GeoIp2\Database\Reader;
use RuntimeException;

class GeoIp
{

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
     * Constructor
     *
     * @param array $config Configuration.
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
     * @param string|\Cake\Network\Request|null $ipAddress An ipv4 or ipv6 address.
     * @return \GeoIp2\Model\AbstractModel
     */
    public function lookup($ipAddress = null)
    {
        if (empty($ipAddress)) {
            $request = new Request();
            $ipAddress = $request->clientIp();
        }
        if ($ipAddress instanceof Request) {
            $ipAddress = $ipAddress->clientIp();
        }

        return $this->_geoIp->{$this->_config['dataType']}($ipAddress);
    }

    /**
     * Checks the configuration data.
     *
     * @param array $config Configuration to check.
     * @return void
     */
    protected function _validateConfig($config)
    {
        if (!isset($config['dataFile'])) {
            throw new RuntimeException('GeoIp database file is not');
        }

        if (empty($config['dataType'])) {
            throw new RuntimeException('GeoIp data type is not specified. Must be city or country.');
        }

        $types = ['city', 'country', 'enterprise', 'domain'];
        if (!in_array($config['dataType'], $types)) {
            throw new RuntimeException(sprintf('Invalid data type `%s`! Must be city or country.', $config['dataType']));
        }
    }
}
