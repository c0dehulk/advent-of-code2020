<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day02;

use Codehulk\AdventOfCode2020\Framework\Output;
use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 02, part 2.
 */
class Part2 implements SolutionInterface
{
    /**
     * @inheritDoc
     */
    public function run(string $input, Output $output)
    {
        $rows = array_filter(explode("\n", $input));
        $valid = 0;
        foreach ($rows as $row) {
            [$constraints, $password] = explode(': ', $row);
            preg_match('/(\d+)-(\d+) (\w+)/i', $constraints, $bits);
            [, $low, $high, $letter] = $bits;

            $isLow = ($password[$low - 1] ?? '') === $letter;
            $isHigh = ($password[$high - 1] ?? '') === $letter;

            if ($isLow xor $isHigh) {
                $valid++;
            }
        }
        return $valid;
    }
}
