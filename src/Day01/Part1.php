<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day01;

use Codehulk\AdventOfCode2020\Framework\Output;
use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 01, part 1.
 */
class Part1 implements SolutionInterface
{
    /**
     * @inheritDoc
     */
    public function run(string $input, Output $output)
    {
        $numbersF = array_filter(explode("\n", $input));
        sort($numbersF);
        $numbersB = array_reverse($numbersF);

        foreach ($numbersF as $first) {
            foreach ($numbersB as $last) {
                if ($first + $last > 2020) {
                    continue;
                }
                if ($first + $last < 2020) {
                    break;
                }
                if ($first + $last == 2020) {
                    return $first * $last;
                }
            }
        }
        return "Failed to find number.";
    }
}
