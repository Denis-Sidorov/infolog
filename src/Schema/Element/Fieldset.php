<?php declare(strict_types=1);


namespace Swarmix\Schema\Element;


use IteratorAggregate;
use Traversable;

/**
 * Class Fieldset
 * @package Swarmix\Element
 */
final class Fieldset implements IteratorAggregate
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var Field[]
     */
    private $container = [];

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
     * @param Field[] $fields
     * @return $this
     */
    public function addAll(array $fields): self
    {
        $this->container = array_merge($this->container, $fields);
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

    /**
     * @return Field[]
     */
    public function all(): array
    {
        return $this->container;
    }

    /**
     * Retrieve an external iterator
     * @link https://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable|Field[] An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator()
    {
        foreach ($this->container as $field) {
            yield $field;
        }
    }
}