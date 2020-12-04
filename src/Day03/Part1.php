<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day03;

use Codehulk\AdventOfCode2020\Framework\Output;
use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Two
 */
class Part1 implements SolutionInterface
{
    /**
     * @inheritDoc
     */
    public function run(string $input, Output $output)
    {
        $rows = array_filter(explode("\n", $input));

        $left = 0;
        $treeCount = 0;
        for ($rowId = 1; $rowId < count($rows); $rowId++) {
            $row = $rows[$rowId];
            $left = ($left + 3) % strlen($row);
            $output->writeValues("rowId", $rowId);
            $output->writeValues("left", $left);
            $output->writeValues("character", $row[$left]);
            $treeCount += ($row[$left] === '#');
        }

        return $treeCount;
    }
}
