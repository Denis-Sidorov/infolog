<?php declare(strict_types=1);


namespace Swarmix\Schema\Element;


/**
 * Class Fieldset
 * @package Swarmix\Element
 */
final class Fieldset
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var Field[]
     */
    private $container;

    /**
     * Fieldset constructor.
     * @param string $code
     */
    public function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param Field $field
     * @return $this
     */
    public function add(Field $field): self
    {
        $this->container[$field->getCode()] = $field;
        return $this;
    }

    /**
     * @param string $code
     * @return Field|null
     */
    public function get(string $code): ?Field
    {
        return $this->container[$code] ?? null;
    }

}