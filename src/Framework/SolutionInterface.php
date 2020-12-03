<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Framework;


/**
 * Describes a solution to an advent of code puzzle.
 */
interface SolutionInterface
{
    /**
     * (Description)
     *
     * @param string $input
     *
     * @return string
     */
    public function run(string $input): string;
}
