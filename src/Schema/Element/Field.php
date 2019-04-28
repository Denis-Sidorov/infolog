<?php declare(strict_types=1);


namespace Swarmix\Schema\Element;


/**
 * Class Field
 * @package Swarmix\Element
 */
final class Field
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $position;

    /**
     * @var int
     */
    private $length;

    /**
     * @var string
     */
    private $value;

    /**
     * Field constructor.
     * @param string $code
     */
    public function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->value;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Field
     */
    public function setName(?string $name): Field
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return Field
     */
    public function setDescription(?string $description): Field
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPosition(): ?int
    {
        return $this->position;
    }

    /**
     * @param int|null $position
     * @return Field
     */
    public function setPosition(?int $position): Field
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getLength(): ?int
    {
        return $this->length;
    }

    /**
     * @param int|null $length
     * @return Field
     */
    public function setLength(?int $length): Field
    {
        $this->length = $length;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     * @return Field
     */
    public function setValue(?string $value): Field
    {
        $this->value = $value;
        return $this;
    }
}