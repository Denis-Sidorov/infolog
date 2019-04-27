<?php declare(strict_types=1);


namespace Swarmix\Reader;


/**
 * Class Parser
 * @package Reader
 */
final class SchemaRow
{
    const FIELDSET_CODE_PREFIX = 'GEEX';
    const FIELD_CODE_PREFIX = "''";
    const WHITESPACE_CHARS = '\t\n\r ';

    const FIELDSET_CODE_INDEX = 0;
    const FIELD_CODE_INDEX = 1;
    const NAME_INDEX = 2;
    const DESCRIPTION_INDEX = 3;
    const POSITION_INDEX = 4;
    const LENGTH_INDEX = 5;

    /**
     * @var string[]
     */
    private $line;

    /**
     * Parser constructor.
     * @param string[] $line
     */
    public function __construct(array $line)
    {
        $this->line = $line;
    }

    /**
     * @return string
     */
    public function getFieldsetCode(): string
    {
        return trim($this->line[self::FIELDSET_CODE_INDEX], self::WHITESPACE_CHARS . self::FIELDSET_CODE_PREFIX);
    }

    /**
     * @return string
     */
    public function getFieldCode(): string
    {
        return trim($this->line[self::FIELD_CODE_INDEX], self::WHITESPACE_CHARS . self::FIELD_CODE_PREFIX);
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return trim($this->line[self::NAME_INDEX], self::WHITESPACE_CHARS) ?: null;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return trim($this->line[self::DESCRIPTION_INDEX], self::WHITESPACE_CHARS);
    }

    /**
     * @return int|null
     */
    public function getPosition(): ?int
    {
        return is_numeric($this->line[self::POSITION_INDEX]) ? (int) $this->line[self::POSITION_INDEX] : null;
    }

    /**
     * @return int|null
     */
    public function getLength(): ?int
    {
        return is_numeric($this->line[self::POSITION_INDEX]) ? (int) $this->line[self::LENGTH_INDEX] : null;
    }
}