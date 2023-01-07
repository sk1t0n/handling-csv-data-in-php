<?php

namespace Sk1t0n\HandlingCsvDataInPhp\Infrastructure;
use Sk1t0n\HandlingCsvDataInPhp\Application\CsvReader;
use Sk1t0n\HandlingCsvDataInPhp\Application\CsvWriter;
use Sk1t0n\HandlingCsvDataInPhp\Domain\CsvFile;

require dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$filename = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'posts.csv';

$header = ['Title', 'Content'];
$data = [
    ['Post 1', 'Post 1 ...'],
    ['Post 2', 'Post 2 ...'],
    ['Post 3', 'Post 3 ...'],
];

// write
$csvFile = new CsvFile($filename, 'w');
$writer = new CsvWriter($csvFile);
$writer->write($data, $header);

// read
$csvFile->setMode('r');
$reader = new CsvReader($csvFile);
foreach ($reader->read() as $row) {
    var_dump($row);
}