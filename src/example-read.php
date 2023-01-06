<?php

namespace Sk1t0n\HandlingCsvDataInPhp;

use League\Csv\Reader;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$filename = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'posts.csv';
if (!file_exists($filename)) {
    die("File {$filename} not found.");
}

$csv = Reader::createFromPath($filename, 'r');
$csv->setHeaderOffset(0);

$records = $csv->getRecords();
foreach($records as $record) {
    var_dump($record);
}
