<?php declare(strict_types=1);


namespace Swarmix\Reader;


use Exception;
use Swarmix\Schema\Schema;
use Swarmix\Schema\Element\Field;
use Swarmix\Schema\Element\Fieldset;

final class SchemaLoader
{
    /**
     * @param string $path
     * @return Schema
     * @throws Exception
     */
    public function load(string $path): Schema
    {
        if (!file_exists($path)) {
            throw new Exception("File not found: {$path}");
        }

        $schemaSource = fopen($path, 'r');
        if ($schemaSource === false) {
            throw new Exception("Can't open infolog schema");
        }

        $schema = new Schema();
        while (($row = fgetcsv($schemaSource, 0, ';')) !== false) {
            $schemaRow = new SchemaRow($row);
            $field = (new Field($schemaRow->getFieldCode()))
                ->setName($schemaRow->getName())
                ->setDescription($schemaRow->getDescription())
                ->setPosition($schemaRow->getPosition())
                ->setLength($schemaRow->getLength());

            $fieldset = $schema->get($schemaRow->getFieldsetCode()) ?? new Fieldset($schemaRow->getFieldsetCode());
            $fieldset->add($field);

            $schema->add($fieldset);
        }

        fclose($schemaSource);
        return $schema;
    }
}