<?php

namespace Swarmix\Tests\Schema;

use Swarmix\Schema\Row;
use PHPUnit\Framework\TestCase;

class RowTest extends TestCase
{
    public function schemaProvider()
    {
        return [
            'zero field' => [
                ["GEEX0000  ","'0000","          ","M00 : D\u00e9but d'\u00e9change              (Obligatoire)","   ","   ","    ","  "," ","  ","   ","                                              "," ","                                              ",""],
                [
                    'fieldsetCode' => '0000',
                    'fieldCode' => '0000',
                    'name' => null,
                    'description' => 'M00 : D\u00e9but d\'\u00e9change              (Obligatoire)',
                    'position' => null,
                    'length' => null
                ]
            ],
            'field' => [
                ["GEEX0000  ", "'0010", "CODEXC    ", "Code du mouvement d'\u00e9change                     ", "1", "2", "2", "0", "N", "DN", "1", "Zone initialis\u00e9e \u00e0 \"00\"                       ", "O", "0", ""],
                [
                    'fieldsetCode' => '0000',
                    'fieldCode' => '0010',
                    'name' => 'CODEXC',
                    'description' => 'Code du mouvement d\'\u00e9change',
                    'position' => 1,
                    'length' => 2
                ]
            ],
        ];
    }

    /**
     * @dataProvider schemaProvider
     */
    public function testGetFieldCode($row, $expected)
    {
        $row = new Row($row);
        assertEquals($expected['fieldCode'], $row->getFieldCode());
    }
    
    /**
     * @dataProvider schemaProvider
     */
    public function testGetDescription($row, $expected)
    {
        $row = new Row($row);
        assertEquals($expected['description'], $row->getDescription());
    }

    /**
     * @dataProvider schemaProvider
     */
    public function testGetName($row, $expected)
    {
        $row = new Row($row);
        assertEquals($expected['name'], $row->getName());
    }

    /**
     * @dataProvider schemaProvider
     */
    public function testGetPosition($row, $expected)
    {
        $row = new Row($row);
        assertEquals($expected['position'], $row->getPosition());
    }

    /**
     * @dataProvider schemaProvider
     */
    public function testGetFieldsetCode($row, $expected)
    {
        $row = new Row($row);
        assertEquals($expected['fieldsetCode'], $row->getFieldsetCode());
    }

    /**
     * @dataProvider schemaProvider
     */
    public function testGetLength($row, $expected)
    {
        $row = new Row($row);
        assertEquals($expected['length'], $row->getLength());
    }
}
