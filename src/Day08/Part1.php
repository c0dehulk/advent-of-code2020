<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day08;

use Codehulk\AdventOfCode2020\Framework\Output;
use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 08, part 1.
 */
class Part1 implements SolutionInterface
{
    /**
     * @inheritDoc
     */
    public function run(string $input, Output $output)
    {
        $instructions = explode("\n", trim($input));

        $accumulator = 0;
        $stack = [];

        $i = 0;
        while (true) {

            if (in_array($i, $stack, true)) {
                break; // Loop
            }
            $stack[] = $i;

            $instruction = $instructions[$i];
            [$operator, $value] = explode(' ', $instruction);

            $jump = 0;
            if ($operator === 'nop') {
                $jump = 1;
            } elseif ($operator === 'jmp') {
                $jump = (int) $value;
            } elseif ($operator === 'acc') {
                $accumulator += (int) $value;
                $jump = 1;
            }

            $i += $jump;
        }

        return $accumulator;
    }
}
