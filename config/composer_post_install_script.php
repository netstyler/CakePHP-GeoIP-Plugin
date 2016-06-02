<?php
/**
 * https://getcomposer.org/doc/articles/scripts.md#scripts
 */

class GeoIpDatabaseDownloader {

    public $files = [
        'GeoLiteCity.dat.gz' => 'http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz',
        'GeoLiteCityv6.dat.gz' => 'http://geolite.maxmind.com/download/geoip/database/GeoLiteCityv6-beta/GeoLiteCityv6.dat.gz'
    ];

    public function __construct($targetFolder) {
        $this->targetFolder = $targetFolder;
    }

    public function download() {
        foreach ($this->files as $file => $url) {
            $this->_download($url, $file);
        }
    }

    public function _download($url, $fileName) {
        $fileName = $this->targetFolder . $fileName;
        file_put_contents($fileName, file_get_contents($url));

        // Raising this value may increase performance
        $bufferSize = 4096; // read 4kb at a time
        $outFileName = str_replace('.gz', '', $fileName);

        // Open our files (in binary mode)
        $file = gzopen($fileName, 'rb');
        $outFile = fopen($outFileName, 'wb');

        // Keep repeating until the end of the input file
        while (!gzeof($file)) {
            // Read buffer-size bytes
            // Both fwrite and gzread and binary-safe
            fwrite($outFile, gzread($file, $bufferSize));
        }

        // Files are done, close files
        fclose($outFile);
        gzclose($file);
        unlink($fileName);
    }
}

echo 'Downloading GeoIP Lite Database, please wait...' . "\n";
$downloader = new GeoIpDatabaseDownloader('data' . DIRECTORY_SEPARATOR);
$downloader->download();
echo 'Download finished.' . "\n";;
