<?php declare(strict_types=1);


namespace Swarmix\Data;


use Exception;
use Swarmix\Schema\Element\Fieldset;

final class Row
{
    const WHITESPACE_CHARS = '\t\n\r ';
    const DESCRIPTION_FIELD_CODE = '0000';
    /**
     * @var string
     */
    private $row;

    /**
     * @var string
     */
    private $code;

    /**
     * Row constructor.
     * @param string $row
     * @throws Exception
     */
    public function __construct(string $row)
    {
        $this->row = $this->removeBom($row);
        $this->code = $this->findCode($this->row);
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param Fieldset $rowSchema
     * @return Fieldset
     * @throws Exception
     */
    public function getFields(Fieldset $rowSchema): Fieldset
    {
        if ($rowSchema->getCode() !== $this->code) {
            throw new Exception("Schema of row doesn't match to row code.");
        }

        $fieldset = new Fieldset($this->code);
        foreach ($rowSchema as $fieldSchema) {
            if ($fieldSchema->getCode() === self::DESCRIPTION_FIELD_CODE) {
                continue;
            }

            $field = clone $fieldSchema;
            $value = substr($this->row, $fieldSchema->getPosition() - 1, $fieldSchema->getLength());
            $value = is_string($value) ? trim($value, self::WHITESPACE_CHARS) : $value;
            $isValidValue = !empty($value) || $value === '0';
            $field->setValue(
            $isValidValue
                ? trim($value, self::WHITESPACE_CHARS)
                : $fieldSchema->getValue()
            );
            $fieldset->add($field);
        }

        return $fieldset;
    }

    /**
     * @param string $row
     * @return string
     * @throws Exception
     */
    private function findCode(string $row): string
    {
        $code = mb_substr($row, 0, 5);
        $code = str_replace('.', '', $code);
        if (mb_strlen($code) !== 4) {
            throw new Exception('Code not found');
        }

        return $code;
    }

    /**
     * @param string $row
     * @return string
     */
    private function removeBom(string $row): string
    {
        $bomDetected = substr($row, 0, 3) === pack('CCC', 0xef, 0xbb, 0xbf);
        return $bomDetected ? substr($row, 3) : $row;
    }

}