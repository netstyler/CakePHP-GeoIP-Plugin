# CakePHP GeoIP Plugin

A CakePHP Plugin for finding a location based on an IP Address using the MaxMind GeoIP database and the PEAR Net_GeoIP package.

## References

* http://www.maxmind.com/app/ip-location
* http://pear.php.net/package/Net_GeoIP/
* http://pear.php.net/manual/en/package.networking.net-geoip.lookuplocation.php

## Installation

1. Copy the plugin to app/Plugin/GeoIp
2. Download the MaxMind GeoLite City Database at http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz
3. Uncompress the database to app/Plugin/GeoIp/data/GeoIP.dat

## Usage

Just load the behavior

```php
class MyModel extends AppModel {
	public $actsAs = array('GeoIp.GeoIp);
}
```

You can then call:

```php
$location = $this->MyModel->ipLookup(CakeRequest::clientIp(false));
```

## Contributing to this Plugin

Please feel free to contribute to the plugin with new issues, requests, unit tests and code fixes or new features. If you want to contribute some code, create a feature branch from develop, and send us your pull request. Unit tests for new features and issues detected are mandatory to keep quality high.

## License

Licensed under [The MIT License](http://www.opensource.org/licenses/mit-license.php)<br/>
Redistributions of files must retain the above copyright notice.
