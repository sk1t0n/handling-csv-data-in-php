<?php

namespace Sk1t0n\HandlingCsvDataInPhp\Entities;

class CsvFile
{
    /** @var string */
    private $filename;

    /** @var string */
    private $mode;

    public function __construct(string $filename, string $mode)
    {
        $this->filename = $filename;
        $this->mode = $mode;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function setFilename(string $filename)
    {
        $this->filename = $filename;
    }

    public function getMode(): string
    {
        return $this->mode;
    }

    public function setMode(string $mode)
    {
        $this->mode = $mode;
    }
}
