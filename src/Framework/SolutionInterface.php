<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Framework;


/**
 * Describes a solution to an advent of code puzzle.
 */
interface SolutionInterface
{
    /**
     * Runs a solution, and returns the output.
     *
     * @param string $input The puzzle input.
     *
     * @return mixed
     */
    public function run(string $input, Output $output);
}
