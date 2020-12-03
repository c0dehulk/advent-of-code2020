<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day03;

use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 03, part 2.
 */
class Part2 implements SolutionInterface
{
    /**
     * @inheritDoc
     */
    public function run(string $input): string
    {
        $rows = array_filter(explode("\n", $input));

        $r1d1 = $this->getTreesOnSlope($rows, 1, 1);
        $r3d1 = $this->getTreesOnSlope($rows, 3, 1);
        $r5d1 = $this->getTreesOnSlope($rows, 5, 1);
        $r7d1 = $this->getTreesOnSlope($rows, 7, 1);
        $r1d2 = $this->getTreesOnSlope($rows, 1, 2);

        return (string) ($r1d1 * $r3d1 * $r5d1 * $r7d1 * $r1d2);
    }

    private function getTreesOnSlope($rows, $x, $y): int
    {
        echo "x: $x\n";
        echo "y: $y\n";

        $right = 0;
        $down = 0;

        $treeCount = 0;
        while ($down < count($rows)) {
            echo "[$right, $down]\n";
            //        echo "character: {$row[$right]}\n";

            $row = $rows[$down];
            $treeCount += ($row[$right] === '#');

            $down += $y;
            $right = ($right + $x) % strlen($row);
        }
        echo "Trees: $treeCount\n";
        return $treeCount;
    }
}
