<?php

declare(strict_types=1);

namespace Sk1t0n\HandlingCsvDataInPhp\UseCases;

use League\Csv\Reader;
use Sk1t0n\HandlingCsvDataInPhp\Entities\CsvFile;

class CsvReader
{
    private Reader $reader;

    /**
     * @throws \Exception
     */
    public function __construct(private CsvFile $file)
    {
        $this->checkFileForExists();
        $this->reader = Reader::createFromPath(
            $this->file->getFilename(),
            $this->file->getMode()->value
        );
    }

    public function read(): \Iterator
    {
        $this->reader->setHeaderOffset(0);

        return $this->reader->getRecords();
    }

    /**
     * @throws \Exception;
     */
    private function checkFileForExists()
    {
        $filename = $this->file->getFilename();

        if (!file_exists($filename)) {
            throw new \Exception("File {$filename} not found.");
        }
    }
}
