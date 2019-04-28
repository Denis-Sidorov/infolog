<?php declare(strict_types=1);


namespace Swarmix\Data;


use Exception;
use Swarmix\Schema\Schema;

/**
 * Class Reader
 * @package Swarmix\Data
 */
final class Reader
{

    /**
     * @var Schema
     */
    private $schema;

    /**
     * Reader constructor.
     * @param Schema $schema
     */
    public function __construct(Schema $schema)
    {
        $this->schema = $schema;
    }

    /**
     * @param string $path
     * @return Container
     * @throws Exception
     */
    public function read(string $path): Container
    {
        if (!file_exists($path)) {
            throw new Exception("File not found: {$path}");
        }

        $dataSource = fopen($path, 'r');
        if ($dataSource === false) {
            throw new Exception("Can't open infolog schema");
        }

        $container = new Container();
        while (($row = fgets($dataSource)) !== false) {
            $dataRow = new Row($row);
            $rowSchema = $this->schema->get($dataRow->getCode());
            $fieldset = $dataRow->getFields($rowSchema);
            $container->add($fieldset);
        }

        fclose($dataSource);
        return $container;
    }

}