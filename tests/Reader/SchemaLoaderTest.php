<?php

namespace Swarmix\Tests\Reader;

use PHPUnit\Framework\TestCase;
use Swarmix\Reader\SchemaLoader;

class SchemaLoaderTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testRead()
    {
        $schemaPath = __DIR__ . '/../../src/resource/schema.csv';
        $loader = new SchemaLoader();
        $schema = $loader->load($schemaPath);

        $set = $schema->get('0000');
        assertNotNull($set, 'No fieldset for "0000" code');

        $field = $set->get('0000');
        assertEquals('0000', $field->getCode());
        assertEquals('M00 : Début d\'échange              (Obligatoire)', $set->get('0000')->getDescription());

        $field = $set->get('0010');
        assertEquals('0010', $field->getCode());
        assertEquals('CODEXC', $field->getName());
        assertEquals('Code du mouvement d\'échange', $field->getDescription());
        assertEquals(1, $field->getPosition());
        assertEquals(2, $field->getLength());
    }
}
