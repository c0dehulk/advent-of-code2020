<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day08;

use Codehulk\AdventOfCode2020\Framework\Output;
use Codehulk\AdventOfCode2020\Framework\SolutionInterface;
use RuntimeException;

/**
 * Solution for day 08, part 2.
 */
class Part2 implements SolutionInterface
{
    /**
     * @inheritDoc
     */
    public function run(string $input, Output $output)
    {
        $instructions = array_map(
            function($raw) {
                return explode(' ', $raw);
            },
            explode("\n", trim($input))
        );

        foreach ($instructions as $id => $instruction) {

            [$operator, $value] = $instruction;
            if ($operator === 'acc') {
                continue; // Can't modify acc instructions.
            }

            $attempt = $instructions;
            if ($operator === 'nop') {
                $attempt[$id] = ['jmp', $instruction[1]];
            } elseif ($operator === 'jmp') {
                $attempt[$id] = ['nop', $instruction[1]];
            }
            try {
                return $this->attemptLoop($attempt);
            } catch (RuntimeException $e) {
                // Bad attempt, still loops.
                continue;
            }
        }
        throw new RuntimeException('No modifications created successful loop');
    }

    private function attemptLoop(array $instructions): int
    {
        $accumulator = 0;
        $stack = [];

        $i = 0;
        while (true) {
            if ($i >= count($instructions)) {
                return $accumulator;
            }
            if (in_array($i, $stack, true)) {
                throw new \RuntimeException('Looped');
            }
            $stack[] = $i;

            $instruction = $instructions[$i];
            [$operator, $value] = $instruction;

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
    }
}
