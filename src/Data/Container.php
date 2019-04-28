<?php declare(strict_types=1);


namespace Swarmix\Data;

use IteratorAggregate;
use Swarmix\Schema\Element\Fieldset;
use Traversable;

/**
 * Class Container
 * @package Swarmix\Data
 */
final class Container implements IteratorAggregate
{
    /**
     * @var Fieldset[]
     */
    private $container = [];

    /**
     * @param Fieldset $fieldset
     * @return $this
     */
    public function add(Fieldset $fieldset): self
    {
        $this->container[] = $fieldset;
        return $this;
    }

    /**
     * @return Fieldset[]
     */
    public function all(): array
    {
        return $this->container;
    }

    /**
     * Retrieve an external iterator
     * @link https://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Fieldset[]|Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator()
    {
        foreach ($this->container as $fieldset) {
            yield $fieldset;
        }
    }
}