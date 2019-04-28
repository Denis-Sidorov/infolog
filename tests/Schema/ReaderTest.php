<?php

namespace Swarmix\Tests\Schema;

use Exception;
use PHPUnit\Framework\TestCase;
use Swarmix\Schema\Reader;

class ReaderTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testRead()
    {
        $schemaPath = __DIR__ . '/../resource/schema.csv';
        $loader = new Reader();
        $schema = $loader->read($schemaPath);

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
