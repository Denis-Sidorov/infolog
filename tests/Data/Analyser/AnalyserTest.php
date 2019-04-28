<?php

namespace Swarmix\Tests\Data\Analyser;

use Exception;
use PHPUnit\Framework\TestCase;
use Swarmix\Data\Analyser\Analyser;
use Swarmix\Data\Reader;
use Swarmix\Schema\Schema;

class AnalyserTest extends TestCase
{
    /**
     * @var Schema
     */
    private static $schema;

    /**
     * @throws Exception
     */
    public static function setUpBeforeClass(): void
    {
        $schemaPath = __DIR__ . '/../../resource/schema.csv';
        $reader = new \Swarmix\Schema\Reader();
        self::$schema = $reader->read($schemaPath);
    }

    /**
     * @throws Exception
     */
    public function testDiff()
    {
        $reader = new Reader(self::$schema);

        $dataPath = __DIR__ . '/../../resource/KK250190401080045.DAT';
        $mainData = $reader->read($dataPath);

        $dataPath = __DIR__ . '/../../resource/KK250190401135322.DAT';
        $slaveData = $reader->read($dataPath);

        $analyser = new Analyser();
        $report = $analyser->diff($mainData, $slaveData);
        assertEqualsCanonicalizing([], $report->getExtraRows());
        assertEqualsCanonicalizing([
            '2000',
            '2001',
            '2002',
            '5005',
        ], $report->getMissingRows());
    }
}
