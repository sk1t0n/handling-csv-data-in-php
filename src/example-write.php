<?php

namespace Sk1t0n\HandlingCsvDataInPhp;

use League\Csv\CannotInsertRecord;
use League\Csv\Writer;
use SplFileObject;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$filename = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'posts.csv';

$header = ['Title', 'Content'];
$records = [
    ['Post 1', 'Post 1 ...'],
    ['Post 2', 'Post 2 ...'],
    ['Post 3', 'Post 3 ...'],
];

try {
    $writer = Writer::createFromFileObject(new SplFileObject($filename, 'w'));
    $writer->insertOne($header);
    $writer->insertAll($records);
} catch (CannotInsertRecord $e) {
    echo 'Error', PHP_EOL;
    var_dump($e->getRecord());
}
