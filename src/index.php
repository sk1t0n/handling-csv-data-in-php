<?php

namespace Sk1t0n\HandlingCsvDataInPhp;

use League\Csv\CannotInsertRecord;
use Sk1t0n\HandlingCsvDataInPhp\Entities\CsvFile;
use Sk1t0n\HandlingCsvDataInPhp\UseCases\CsvReader;
use Sk1t0n\HandlingCsvDataInPhp\UseCases\CsvWriter;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);

$filename = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'posts.csv';
$dir = dirname($filename);
if (!file_exists($dir)) {
    mkdir($dir);
}

$header = ['Title', 'Content'];
$data = [
    ['Post 1', 'Post 1 ...'],
    ['Post 2', 'Post 2 ...'],
    ['Post 3', 'Post 3 ...'],
];

// write
try {
    $csvFile = new CsvFile($filename, 'w');
    $writer = new CsvWriter($csvFile);
    $writer->write($data, $header);
} catch (CannotInsertRecord $e) {
    die($e->getMessage());
}

// read
try {
    $csvFile->setMode('r');
    $reader = new CsvReader($csvFile);
    foreach ($reader->read() as $row) {
        echo '<pre>';
        var_dump($row);
        echo '</pre>';
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
