<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day12;

use Codehulk\AdventOfCode2020\Framework\Output;
use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 12, part 1.
 */
class Part1 implements SolutionInterface
{
    /**
     * @inheritDoc
     */
    public function run(string $input, Output $output)
    {
        $instructions = explode("\n", trim($input));

        $position = [0, 0, 'E'];
        foreach ($instructions as $instruction) {
            $output->writeValues($position);
            $position = $this->move($instruction, $position);
        }
        $output->writeValues($position);

        return abs($position[0]) + abs($position[1]);
    }

    private function move(string $instruction, array $position): array
    {
        [$x, $y, $orientation] = $position;

        $operation = $instruction[0];
        $distance = (int) substr($instruction, 1);
        switch ($operation) {
            case 'N':
                return [$x, $y + $distance, $orientation];
            case 'E':
                return [$x + $distance, $y, $orientation];
            case 'S':
                return [$x, $y - $distance, $orientation];
            case 'W':
                return [$x - $distance, $y, $orientation];
            case 'F':
                return $this->move($orientation . $distance, $position);
            case 'R':
            case 'L':
                return [$x, $y, $this->rotate($orientation, $operation, $distance)];
        }
        throw new \Exception('Invalid instruction.');
    }

    public function rotate(string $current, string $direction, int $angle): string
    {
        $compass = ['N', 'E', 'S', 'W'];
        $change = ($angle / 90) * ($direction === 'R' ? 1 : -1);
        $orientationId = (array_search($current, $compass) + $change + 4) % 4;
        return $compass[$orientationId];
    }
}


