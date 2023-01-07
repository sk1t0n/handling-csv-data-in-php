<?php

namespace Sk1t0n\HandlingCsvDataInPhp\Tests\Unit\Application;

use PHPUnit\Framework\TestCase;
use Sk1t0n\HandlingCsvDataInPhp\Application\CsvWriter;
use Sk1t0n\HandlingCsvDataInPhp\Domain\CsvFile;

class CsvWriterTest extends TestCase
{
    public function test_write()
    {
        $filename = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'test.csv';
        $file = new CsvFile($filename, 'w');
        $writer = new CsvWriter($file);

        $data = [
            [1, 2, 3],
            [4, 5, 6]
        ];
        $writer->write($data);
        $isExists = file_exists($filename);
        $this->assertTrue($isExists);
        unlink($filename);
        $isExists = file_exists($filename);
        $this->assertFalse($isExists);
    }

    public function test_write_when_exception()
    {
        $filename = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'test.csv';
        $file = new CsvFile($filename, 'r');
        
        try {
            $writer = new CsvWriter($file);
            $writer->write([]);
        } catch (\Exception $e) {
            $this->assertSame(
                "fopen($filename): Failed to open stream: No such file or directory",
                $e->getMessage()
            );
        }
    }
}
