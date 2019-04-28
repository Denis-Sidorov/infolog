<?php declare(strict_types=1);


namespace Swarmix\Data\Analyser;


/**
 * Class Report
 * @package Swarmix\Data\Diff
 */
final class Report
{
    /**
     * @var string[]
     */
    private $extraRows = [];

    /**
     * @var string[]
     */
    private $missingRows = [];

    /**
     * @var FieldsPair[]
     */
    private $extraFields = [];

    /**
     * @var FieldsPair[]
     */
    private $missingFields = [];

    /**
     * @return mixed
     */
    public function getExtraRows()
    {
        return $this->extraRows;
    }

    /**
     * @param mixed $extraRows
     * @return Report
     */
    public function setExtraRows($extraRows)
    {
        $this->extraRows = $extraRows;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMissingRows()
    {
        return $this->missingRows;
    }

    /**
     * @param mixed $missingRows
     * @return Report
     */
    public function setMissingRows($missingRows)
    {
        $this->missingRows = $missingRows;
        return $this;
    }

    /**
     * @return FieldsPair[]
     */
    public function getExtraFields()
    {
        return $this->extraFields;
    }

    /**
     * @param FieldsPair $fieldsPair
     * @return $this
     */
    public function addExtraField(FieldsPair $fieldsPair): self
    {
        $this->extraFields[] = $fieldsPair;
        return $this;
    }

    /**
     * @return FieldsPair[]
     */
    public function getMissingFields()
    {
        return $this->missingFields;
    }

    /**
     * @param FieldsPair $fieldsPair
     * @return $this
     */
    public function addMissingField(FieldsPair $fieldsPair): self
    {
        $this->missingFields[] = $fieldsPair;
        return $this;
    }
}