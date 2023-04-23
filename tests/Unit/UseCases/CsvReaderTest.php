<?php

declare(strict_types=1);

namespace Sk1t0n\HandlingCsvDataInPhp\Tests\Unit\UseCases;

use PHPUnit\Framework\TestCase;
use Sk1t0n\HandlingCsvDataInPhp\Entities\CsvFile;
use Sk1t0n\HandlingCsvDataInPhp\Enums\CsvFileMode;
use Sk1t0n\HandlingCsvDataInPhp\UseCases\CsvReader;

/**
 * @internal
 *
 * @coversNothing
 */
class CsvReaderTest extends TestCase
{
    public function testCheckFileForExistsWhenFileExists()
    {
        $filename = dirname(__DIR__, 3).'/data/posts.csv';
        $file = new CsvFile($filename, CsvFileMode::READ);
        $reader = new CsvReader($file);
        $this->assertNotNull($reader);
    }

    public function testCheckFileForExistsWhenFileNotExists()
    {
        $filename = dirname(__DIR__, 3).'/data/not_exists.csv';
        $file = new CsvFile($filename, CsvFileMode::READ);

        try {
            new CsvReader($file);
        } catch (\Exception $e) {
            $this->assertSame("File {$filename} not found.", $e->getMessage());
        }
    }

    public function testRead()
    {
        $filename = dirname(__DIR__, 3).'/data/posts.csv';
        $file = new CsvFile($filename, CsvFileMode::READ);
        $reader = new CsvReader($file);
        $result = $reader->read();
        $this->assertNotEmpty($result);
        $this->assertCount(3, $result);
    }
}
