<?php

declare(strict_types=1);

use League\Csv\CannotInsertRecord;
use Sk1t0n\HandlingCsvDataInPhp\UseCases\CsvReader;
use Sk1t0n\HandlingCsvDataInPhp\UseCases\CsvWriter;

require dirname(__DIR__).'/vendor/autoload.php';

require dirname(__DIR__).'/bootstrap/dotenv.php';

require_once dirname(__DIR__).'/config/app.php';

error_reporting(E_ALL & ~E_DEPRECATED);

$dir = dirname(CSV_FILENAME);
if (!file_exists($dir)) {
    mkdir($dir);
}

/** @var DI\Container */
$container = require dirname(__DIR__).'/bootstrap/container.php';

// write
try {
    /** @var CsvWriter */
    $writer = $container->get('csv.writer');
    $writer->write(CSV_DATA, CSV_HEADER);
} catch (CannotInsertRecord $e) {
    dd($e->getMessage());
}

// read
try {
    /** @var CsvReader */
    $reader = $container->get('csv.reader');
    $result = [...$reader->read()];
    dump($result);
} catch (\Exception $e) {
    echo $e->getMessage();
}
