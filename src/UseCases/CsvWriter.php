<?php

declare(strict_types=1);

namespace Sk1t0n\HandlingCsvDataInPhp\UseCases;

use League\Csv\CannotInsertRecord;
use League\Csv\Writer;
use Sk1t0n\HandlingCsvDataInPhp\Entities\CsvFile;

class CsvWriter
{
    private Writer $writer;

    public function __construct(private CsvFile $file)
    {
        $this->writer = Writer::createFromPath(
            $this->file->getFilename(),
            $this->file->getMode()->value
        );
    }

    /**
     * Saves data in a csv file.
     *
     * @param null|array $header csf file header
     *
     * @throws CannotInsertRecord
     */
    public function write(array $data, ?array $header = null)
    {
        try {
            if ($header) {
                $this->writer->insertOne($header);
            }

            $this->writer->insertAll($data);
        } catch (CannotInsertRecord $e) {
            throw $e;
        }
    }
}
