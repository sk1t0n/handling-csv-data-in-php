<?php

declare(strict_types=1);

use Sk1t0n\HandlingCsvDataInPhp\Enums\CsvFileMode;

use function DI\create;
use function DI\get;

return [
    'csv.file.write' => create('Sk1t0n\HandlingCsvDataInPhp\Entities\CsvFile')
        ->constructor(CSV_FILENAME, CsvFileMode::WRITE),
    'csv.file.read' => create('Sk1t0n\HandlingCsvDataInPhp\Entities\CsvFile')
        ->constructor(CSV_FILENAME, CsvFileMode::READ),
    'csv.writer' => create('Sk1t0n\HandlingCsvDataInPhp\UseCases\CsvWriter')
        ->constructor(get('csv.file.write')),
    'csv.reader' => create('Sk1t0n\HandlingCsvDataInPhp\UseCases\CsvReader')
        ->constructor(get('csv.file.read')),
];
