<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day06;

use Codehulk\AdventOfCode2020\Framework\Output;
use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 06, part 1.
 */
class Part1 implements SolutionInterface
{
    /**
     * @inheritDoc
     */
    public function run(string $input, Output $output)
    {
        $total = 0;
        $groups = explode("\n\n", trim($input));
        foreach ($groups as $group) {
            $group = preg_replace('/[^a-z]/', '', $group);
            $total += strlen(count_chars($group, 3));
        }
        return $total;
    }
}
