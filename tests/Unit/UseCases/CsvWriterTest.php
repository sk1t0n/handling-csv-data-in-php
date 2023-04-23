<?php

declare(strict_types=1);

namespace Sk1t0n\HandlingCsvDataInPhp\Tests\Unit\UseCases;

use PHPUnit\Framework\TestCase;
use Sk1t0n\HandlingCsvDataInPhp\Entities\CsvFile;
use Sk1t0n\HandlingCsvDataInPhp\Enums\CsvFileMode;
use Sk1t0n\HandlingCsvDataInPhp\UseCases\CsvWriter;

/**
 * @internal
 *
 * @coversNothing
 */
class CsvWriterTest extends TestCase
{
    public function testWrite()
    {
        $filename = dirname(__DIR__, 3).'/data/test.csv';
        $file = new CsvFile($filename, CsvFileMode::WRITE);
        $writer = new CsvWriter($file);

        $data = [
            [1, 2, 3],
            [4, 5, 6],
        ];
        $writer->write($data);
        $isExists = file_exists($filename);
        $this->assertTrue($isExists);
        unlink($filename);
        $isExists = file_exists($filename);
        $this->assertFalse($isExists);
    }

    public function testWriteWhenException()
    {
        $filename = dirname(__DIR__, 3).'/data/test.csv';
        $file = new CsvFile($filename, CsvFileMode::READ);

        try {
            $writer = new CsvWriter($file);
            $writer->write([]);
        } catch (\Exception $e) {
            $this->assertSame(
                "fopen({$filename}): Failed to open stream: No such file or directory",
                $e->getMessage()
            );
        }
    }
}
