<?php declare(strict_types=1);


namespace Swarmix\Data\Analyser;


use Swarmix\Data\Container;

/**
 * Class Diff
 * @package Swarmix\Data
 */
final class Analyser
{
    /**
     * @param Container $main
     * @param Container $slave
     * @return Report
     */
    public function diff(Container $main, Container $slave): Report
    {
        $mainCodes = $main->getCodes();
        $slaveCodes = $slave->getCodes();

        $report = (new Report())
            ->setExtraRows(array_diff($mainCodes, $slaveCodes))
            ->setMissingRows(array_diff($slaveCodes, $mainCodes));

        $intersect = array_intersect($mainCodes, $slaveCodes);
        foreach ($main as $mainFieldset) {
            if (!in_array($mainFieldset->getCode(), $intersect)) {
                continue;
            }

            foreach ($slave as $slaveFieldset) {
                if ($mainFieldset->getCode() !== $slaveFieldset->getCode()) {
                    continue;
                }

                foreach ($mainFieldset as $mainField) {
                    $slaveField = $slaveFieldset->get($mainField->getCode());
                    $pair = new FieldsPair($mainField, $slaveField);
                    if ($pair->compare() === FieldsPair::COMPARE_STATUS_EXTRA) {
                        $report->addExtraField($pair);
                    } elseif ($pair->compare() === FieldsPair::COMPARE_STATUS_MISSING) {
                        $report->addMissingField($pair);
                    }
                }

                // Can't break because of repeatable codes
            }
        }

        return $report;
    }
}