<?php

namespace Sk1t0n\HandlingCsvDataInPhp\Tests\Unit\Application;

use PHPUnit\Framework\TestCase;
use Sk1t0n\HandlingCsvDataInPhp\Application\CsvReader;
use Sk1t0n\HandlingCsvDataInPhp\Domain\CsvFile;

class CsvReaderTest extends TestCase
{
    public function test_check_file_for_exists_when_file_exists()
    {
        $filename = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'posts.csv';
        $file = new CsvFile($filename, 'r');
        $reader = new CsvReader($file);
        $this->assertNotNull($reader);
    }

    public function test_check_file_for_exists_when_file_not_exists()
    {
        $filename = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'not_exists.csv';
        $file = new CsvFile($filename, 'r');
        
        try {
            new CsvReader($file);
        } catch (\Exception $e) {
            $this->assertSame("File $filename not found.", $e->getMessage());
        }
    }

    public function test_read()
    {
        $filename = dirname(__DIR__, 3) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'posts.csv';
        $file = new CsvFile($filename, 'r');
        $reader = new CsvReader($file);
        $result = $reader->read();
        $this->assertNotEmpty($result);
        $this->assertCount(3, $result);
    }
}
