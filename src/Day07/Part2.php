<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day07;

use Codehulk\AdventOfCode2020\Framework\Output;
use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 07, part 2.
 */
class Part2 implements SolutionInterface
{
    /**
     * @inheritDoc
     */
    public function run(string $input, Output $output)
    {
        $bags = (new Part1)->getTree($input);
        return $bags['shiny gold']->getSize() - 1; // How many bags does it contain? As in, non-inclusive of itself.
    }
}
