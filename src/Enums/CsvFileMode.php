<?php

declare(strict_types=1);

namespace Sk1t0n\HandlingCsvDataInPhp\Enums;

enum CsvFileMode: string
{
    case READ = 'r';

    case WRITE = 'w';
}
