<?php

namespace Swarmix\Tests\Data;

use Exception;
use Swarmix\Data\Row;
use PHPUnit\Framework\TestCase;
use Swarmix\Schema\Reader;
use Swarmix\Schema\Schema;

class RowTest extends TestCase
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
        $schemaPath = __DIR__ . '/../resource/schema.csv';
        $reader = new Reader();
        self::$schema = $reader->read($schemaPath);
    }

    public function dataProvider()
    {
        return [
            '00.00' => [
                '00.001                            20190401080045                                        Preparation Orders',
                [
                    'code' => '0000',
                    'fields' => [
                        '0070' => '20190401',
                        '0080' => '080045',
                        '0090' => null,
                        '0150' => 'Preparation Orders',
                    ]
                ]
            ],
            '50.00 (1)' => [
                '50.002           BXTBAXTER        19000158                      STD2019040115:0BAXTER                          STD                                                                                                                                    BXT',
                [
                    'code' => '5000',
                    'fields' => [
                        '0070' => 'BXT',
                        '0080' => 'BAXTER',
                        '0090' => '19000158',
                        '0100' => 'STD',
                        '0110' => '20190401',
                        '0120' => '15:0',
                        '0130' => 'BAXTER',
                        '0150' => null,
                        '0170' => 'STD',
                        '0240' => 'BXT',
                        '0270' => null
                    ]
                ]
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @throws Exception
     */
    public function testGetCode($row, $expected)
    {
        $row = new Row($row);
        assertEquals($expected['code'], $row->getCode());
    }

    /**
     * @dataProvider dataProvider
     * @throws Exception
     */
    public function testGetFields($row, $expected)
    {
        $row = new Row($row);
        $rowSchema = self::$schema->get($row->getCode());

        $fieldset = $row->getFields($rowSchema);
        foreach ($expected['fields'] as $code => $value) {
            assertEquals(
                $value,
                $fieldset->get($code)->getValue(),
                "Code: {$row->getCode()}, field: {$fieldset->get($code)->getName()}"
            );
        }
    }

}
