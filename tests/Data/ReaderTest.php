<?php

namespace Swarmix\Tests\Data;

use Exception;
use PHPUnit\Framework\TestCase;
use Swarmix\Data\Reader;
use Swarmix\Schema\Schema;

class ReaderTest extends TestCase
{
    /**
     * @var Schema
     */
    private static $schema;

    public function dataProvider()
    {
        return [
            'KK250190401080045.DAT' => [
                'KK250190401080045.DAT',
                [
                    '0000' => [
                        '0070' => '20190401',
                        '0080' => '080045',
                        '0090' => null,
                        '0150' => 'Preparation Orders',
                    ],
                    '5000' => [
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
                    ],
                ]
            ],
            'KK250190401135322.DAT' => [
                'KK250190401135322.DAT',
                [
                    '0000' => [
                        '0070' => '20190401',
                        '0080' => '135322',
                        '0090' => null,
                        '0150' => 'Preparation Orders',
                    ],
                    '5000' => [
                        'code' => '5000',
                        'fields' => [
                            '0070' => 'LEX',
                            '0080' => 'OJSC SUN InBev',
                            '0090' => '1-297428377213',
                            '0100' => 'FTL',
                            '0110' => '20190401',
                            '0120' => '1700',
                            '0130' => 'BAXTER',
                            '0150' => null,
                            '0160' => 'STD',
                            '0170' => 'FTL',
                            '0240' => 'LEX',
                            '0270' => null
                        ]
                    ],
                ]
            ],
        ];
    }

    /**
     * @throws Exception
     */
    public static function setUpBeforeClass(): void
    {
        $schemaPath = __DIR__ . '/../resource/schema.csv';
        $reader = new \Swarmix\Schema\Reader();
        self::$schema = $reader->read($schemaPath);
    }

    /**
     * @dataProvider dataProvider
     * @throws Exception
     */
    public function testRead($filename, $rows)
    {
        $dataPath = __DIR__ . '/../resource/' . $filename;
        $reader = new Reader(self::$schema);
        $data = $reader->read($dataPath);
        foreach ($data as $fieldset) {
            if (!isset($rows[$fieldset->getCode()])) {
                continue;
            }

            $expectedFields = $rows[$fieldset->getCode()];
            foreach ($fieldset as $field) {
                if (!isset($expectedFields[$field->getCode()])) {
                    continue;
                }

                assertEquals(
                    $expectedFields[$field->getCode()],
                    $field->getValue(),
                    "Code: {$fieldset->getCode()}, field: {$field->getName()}"
                );
            }
        }
    }
}
