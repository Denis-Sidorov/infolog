<?php declare(strict_types=1);


namespace Swarmix\Schema;

use Swarmix\Schema\Element\Fieldset;

/**
 * Class Registry
 * @package Swarmix\Schema
 */
final class Schema
{
    /**
     * @var Fieldset[]
     */
    private $container;

    /**
     * @param Fieldset $fieldset
     * @return $this
     */
    public function add(Fieldset $fieldset): self
    {
        $this->container[$fieldset->getCode()] = $fieldset;
        return $this;
    }

    /**
     * @param string $code
     * @return Fieldset|null
     */
    public function get(string $code): ?Fieldset
    {
        return $this->container[$code] ?? null;
    }
}