<?php
/**
 * https://getcomposer.org/doc/articles/scripts.md#scripts
 */

class GeoIpDatabaseDownloader {

    public $files = [
        'GeoLite2-City.mmdb.gz' => 'http://geolite.maxmind.com/download/geoip/database/GeoLite2-City.mmdb.gz',
        'GeoLite2-Country.mmdb.gz' => 'http://geolite.maxmind.com/download/geoip/database/GeoLite2-Country.mmdb.gz',
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
        if (file_exists($fileName)) {
            return;
        }

        file_put_contents($fileName, file_get_contents($url));
        $outFileName = str_replace('.gz', '', $fileName);
        $this->gunzip($fileName, $outFileName);

        unlink($fileName);
    }

    public function gunzip($fileName, $outFileName) {
        // Raising this value may increase performance
        $bufferSize = 4096; // read 4kb at a time

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
    }
}

echo 'Downloading GeoIP Lite Database, please wait...' . "\n";
$downloader = new GeoIpDatabaseDownloader('data' . DIRECTORY_SEPARATOR);
$downloader->download();
echo 'Download finished.' . "\n";;
