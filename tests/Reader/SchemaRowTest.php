<?php

namespace Swarmix\tests\Reader;

use Swarmix\Reader\SchemaRow;
use PHPUnit\Framework\TestCase;

class SchemaRowTest extends TestCase
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
    public function testGetFieldCode($line, $expected)
    {
        $parser = new SchemaRow($line);
        assertEquals($expected['fieldCode'], $parser->getFieldCode());
    }
    
    /**
     * @dataProvider schemaProvider
     */
    public function testGetDescription($line, $expected)
    {
        $parser = new SchemaRow($line);
        assertEquals($expected['description'], $parser->getDescription());
    }

    /**
     * @dataProvider schemaProvider
     */
    public function testGetName($line, $expected)
    {
        $parser = new SchemaRow($line);
        assertEquals($expected['name'], $parser->getName());
    }

    /**
     * @dataProvider schemaProvider
     */
    public function testGetPosition($line, $expected)
    {
        $parser = new SchemaRow($line);
        assertEquals($expected['position'], $parser->getPosition());
    }

    /**
     * @dataProvider schemaProvider
     */
    public function testGetFieldsetCode($line, $expected)
    {
        $parser = new SchemaRow($line);
        assertEquals($expected['fieldsetCode'], $parser->getFieldsetCode());
    }

    /**
     * @dataProvider schemaProvider
     */
    public function testGetLength($line, $expected)
    {
        $parser = new SchemaRow($line);
        assertEquals($expected['length'], $parser->getLength());
    }
}
