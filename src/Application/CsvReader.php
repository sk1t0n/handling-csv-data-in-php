<?php

namespace Sk1t0n\HandlingCsvDataInPhp\Application;

use Sk1t0n\HandlingCsvDataInPhp\Domain\CsvFile;
use League\Csv\Reader;

class CsvReader
{
    /** @var CsvFile */
    private $file;

    /** @var Reader */
    private $reader;

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
     * @return void|never
     */
    private function checkFileForExists()
    {
        $filename = $this->file->getFilename();
        
        if (!file_exists($filename)) {
            die("File {$filename} not found.");
        }
    }

    public function read(): \Iterator
    {
        $this->reader->setHeaderOffset(0);
        return $this->reader->getRecords();
    }
}
