<?php
use Cake\Core\Configure;
use Cake\Core\Plugin;

Configure::write('GeoIp', [
    'dataFile' => Plugin::path('Netstyler/GeoIp') . DS . 'data' . DS . 'GeoLite2-City.mmdb',
    'dataType' => 'city'
]);
