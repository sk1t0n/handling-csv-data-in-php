<?php

namespace Sk1t0n\HandlingCsvDataInPhp\UseCases;

use Sk1t0n\HandlingCsvDataInPhp\Entities\CsvFile;
use League\Csv\Reader;

class CsvReader
{
    /** @var CsvFile */
    private $file;

    /** @var Reader */
    private $reader;

    /**
     * @param CsvFile $file
     * @throws \Exception
     */
    public function __construct(CsvFile $file)
    {
        $this->file = $file;
        $this->checkFileForExists();
        $this->reader = Reader::createFromPath(
            $this->file->getFilename(),
            $this->file->getMode()
        );
    }

    /**
     * @throws \Exception;
     * @return void
     */
    private function checkFileForExists()
    {
        $filename = $this->file->getFilename();
        
        if (!file_exists($filename)) {
            throw new \Exception("File {$filename} not found.");
        }
    }

    public function read(): \Iterator
    {
        $this->reader->setHeaderOffset(0);
        return $this->reader->getRecords();
    }
}
