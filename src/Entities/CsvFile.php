<?php

declare(strict_types=1);

namespace Sk1t0n\HandlingCsvDataInPhp\Entities;

use Sk1t0n\HandlingCsvDataInPhp\Enums\CsvFileMode;

class CsvFile
{
    public function __construct(
        private string $filename,
        private CsvFileMode $mode
    ) {
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function setFilename(string $filename)
    {
        $this->filename = $filename;
    }

    public function getMode(): CsvFileMode
    {
        return $this->mode;
    }

    public function setMode(CsvFileMode $mode)
    {
        $this->mode = $mode;
    }
}
