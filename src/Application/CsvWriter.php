<?php

namespace Sk1t0n\HandlingCsvDataInPhp\Application;

use League\Csv\CannotInsertRecord;
use League\Csv\Writer;
use Sk1t0n\HandlingCsvDataInPhp\Domain\CsvFile;

class CsvWriter
{
    /** @var CsvFile */
    private $file;

    /** @var Writer */
    private $writer;

    public function __construct(CsvFile $file)
    {
        $this->file = $file;
        $this->writer = Writer::createFromPath(
            $this->file->getFilename(),
            $this->file->getMode()
        );
    }

    /**
     * Saves data in a csv file.
     * 
     * @param array $data
     * @param array|null $header csf file header
     * @return void
     */
    public function write(array $data, array $header = null)
    {
        try {
            if ($header) {
                $this->writer->insertOne($header);
            }
            
            $this->writer->insertAll($data);
        } catch(CannotInsertRecord $e) {
            echo 'Error', PHP_EOL;
            var_dump($e->getRecord());
        }
    }
}
