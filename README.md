# CakePHP GeoIP Plugin

A CakePHP Plugin for finding a location based on an IP Address using the MaxMind GeoIP database and the PEAR Net_GeoIP package.

## Installation

Install the plugin via composer. It should download the required GeoIp DB files during the installation process.

```
composer require netstyler/geoip 2.*
```

Load the plugin including it's bootstrap in your applications bootstrap.php:

```php
Plugin::load('Netstyler/GeoIp', [
    'bootstrap' => true
]);
```

## Usage

```php
use Netstyler\GeoIp\GeoIp;

$geoIp = $new GeoIp();
// Use a Cake\Network\Request object where available
$geoIp->lookup($this->request);
// Or just pass an ip from somewhere else
$geoIp->lookup($ipAddress);
```

## Contributing to this Plugin

Please feel free to contribute to the plugin with new issues, requests, unit tests and code fixes or new features. If you want to contribute some code, create a feature branch from develop, and send us your pull request. Unit tests for new features and issues detected are mandatory to keep quality high.

## License

Licensed under [The MIT License](http://www.opensource.org/licenses/mit-license.php)<br/>
Redistributions of files must retain the above copyright notice.
