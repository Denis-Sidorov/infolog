<?php declare(strict_types=1);


namespace Swarmix\Schema;


use Exception;
use Swarmix\Schema\Element\Field;
use Swarmix\Schema\Element\Fieldset;

final class Reader
{
    /**
     * @param string $path
     * @return Schema
     * @throws Exception
     */
    public function read(string $path): Schema
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
            $schemaRow = new Row($row);
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