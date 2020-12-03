<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day01;

use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 01, part 2.
 */
class Part2 implements SolutionInterface
{
    /**
     * @inheritDoc
     */
    public function run(string $input): string
    {
        $numbers = array_filter(explode("\n", $input));
        sort($numbers);
        $last = count($numbers) - 1;

        for ($x = 0; $x <= $last; $x++) {
            for ($y = 0; $y <= $last; $y++) {
                for ($z = 0; $z <= $last; $z++) {
                    if ($numbers[$x] + $numbers[$y] + $numbers[$z] == 2020) {
                        return (string) ($numbers[$x] * $numbers[$y] * $numbers[$z]);
                    }
                }
            }
        }
        return "Failed to find number.";
    }
}
