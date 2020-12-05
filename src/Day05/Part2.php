<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day05;

use Codehulk\AdventOfCode2020\Framework\Output;
use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 05, part 2.
 */
class Part2 implements SolutionInterface
{
    /**
     * @inheritDoc
     */
    public function run(string $input, Output $output)
    {
        $seatIds = [];

        $passes = explode("\n", trim($input));
        foreach ($passes as $pass) {
            $output->writeLn($pass);

            $rowMin = 0;
            $rowMax = 128;
            $colMin = 0;
            $colMax = 8;

            foreach (str_split($pass) as $char) {
                if ($char === 'F') {
                    $rowMax = $rowMin + (($rowMax - $rowMin) / 2);
                } elseif ($char === 'B') {
                    $rowMin = $rowMin + (($rowMax - $rowMin) / 2);
                } elseif ($char === 'L') {
                    $colMax = $colMin + (($colMax - $colMin) / 2);
                } elseif ($char === 'R') {
                    $colMin = $colMin + (($colMax - $colMin) / 2);
                }
            }

            $seatId = ($rowMin * 8) + $colMin;
            $seatIds[] = $seatId;

            $output->writeValues($rowMin, $colMin, $seatId);
        }

        sort($seatIds);
        for ($i = 0; $i < count($seatIds); $i++) {
            $seatId = $seatIds[$i];
            if ($seatIds[$i+1] !== $seatId + 1) {
                return $seatId + 1;
            }
        }
        return 'No seat';
    }
}
