<?php declare(strict_types=1);


namespace Swarmix\Data\Analyser;


use Swarmix\Schema\Element\Field;

/**
 * Class FieldsDifference
 * @package Swarmix\Data\Diff
 */
final class FieldsPair
{
    const COMPARE_STATUS_EQUAL = 'equal';
    const COMPARE_STATUS_EXTRA = 'extra';
    const COMPARE_STATUS_MISSING = 'missing';

    /**
     * @var Field
     */
    private $mainField;

    /**
     * @var Field
     */
    private $slaveField;

    /**
     * FieldsDifference constructor.
     * @param Field $mainField
     * @param Field $slaveField
     */
    public function __construct(Field $mainField, Field $slaveField)
    {
        $this->mainField = $mainField;
        $this->slaveField = $slaveField;
    }

    /**
     * @return string
     */
    public function compare(): string
    {
        if (is_null($this->mainField->getValue()) && !is_null($this->slaveField->getValue())) {
            return self::COMPARE_STATUS_MISSING;
        } elseif (!is_null($this->mainField->getValue()) && is_null($this->slaveField->getValue())) {
            return self::COMPARE_STATUS_EXTRA;
        }

        return self::COMPARE_STATUS_EQUAL;
    }

    /**
     * @return Field
     */
    public function getMainField(): Field
    {
        return $this->mainField;
    }

    /**
     * @return Field
     */
    public function getSlaveField(): Field
    {
        return $this->slaveField;
    }
}