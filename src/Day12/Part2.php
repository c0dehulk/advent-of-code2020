<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day12;

use Codehulk\AdventOfCode2020\Framework\Output;
use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 12, part 2.
 */
class Part2 implements SolutionInterface
{
    /**
     * @var Output
     */
    private Output $output;

    /**
     * @inheritDoc
     */
    public function run(string $input, Output $output)
    {
        $instructions = explode("\n", trim($input));

        $waypoint = [10, 1];
        $position = [0, 0];
        $output->writeValues($position, $waypoint);
        foreach ($instructions as $instruction) {
            $operation = $instruction[0];
            $distance = (int) substr($instruction, 1);

            switch ($operation) {
                case 'F':
                    $position = $this->moveToWaypoint($position, $waypoint, $distance);
                    break;
                case 'N':
                case 'E':
                case 'S':
                case 'W':
                    $waypoint = $this->moveWaypoint($operation, $distance, $waypoint);
                    break;
                case 'L':
                case 'R':
                    $waypoint = $this->rotateWaypoint($operation, $distance, $waypoint);
                    break;
            }
            $output->writeValues($instruction, $position, $waypoint);
        }

        return abs($position[0]) + abs($position[1]);
    }

    private function rotateWaypoint(string $direction, int $angle, array $waypoint)
    {
        [$x, $y] = $waypoint;

        $translations = [
            0 => [1, 1], // 0 or 360
            1 => [1, -1], // 90
            2 => [-1, -1], // 180
            3 => [-1, 1], // 270
        ];

        $change = ($angle / 90) * ($direction === 'R' ? 1 : -1);
        $translationId = ($change + 4) % 4;
        $translation = $translations[$translationId];

        if ($translationId & 1 === 1) {
            $temp = $x;
            $x = $y;
            $y = $temp;
        }

        return [
            $x * $translation[0],
            $y * $translation[1],
        ];
    }

    private function moveWaypoint(string $operation, int $distance, array $position): array
    {
        [$x, $y] = $position;
        switch ($operation) {
            case 'N':
                return [$x, $y + $distance];
            case 'E':
                return [$x + $distance, $y];
            case 'S':
                return [$x, $y - $distance];
            case 'W':
                return [$x - $distance, $y];
        }
        throw new \Exception('Invalid instruction.');
    }

    private function moveToWaypoint(array $position, array $waypoint, int $distance): array
    {
        return [
            $position[0] + ($waypoint[0] * $distance),
            $position[1] + ($waypoint[1] * $distance),
        ];
    }
}
