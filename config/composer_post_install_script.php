<?php
/**
 * https://getcomposer.org/doc/articles/scripts.md#scripts
 */
$ds = DIRECTORY_SEPARATOR;
require 'src' . $ds . 'GeoIpDatabaseDownloader.php';
use Netstyler\GeoIp\GeoIpDatabaseDownloader;

echo 'Downloading GeoIP Lite Database, please wait...' . "\n";
$downloader = new GeoIpDatabaseDownloader('data' . DIRECTORY_SEPARATOR);
$downloader->download();
echo 'Download finished.' . "\n";;
