<?php
/**
 * https://getcomposer.org/doc/articles/scripts.md#scripts
 */

$ds = DIRECTORY_SEPARATOR;

$fileName = 'data' . $ds . ' GeoLiteCity.dat.gz';
$url = 'http://geolite.maxmind.com/download/geoip/database/GeoLiteCity.dat.gz';

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
