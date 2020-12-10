<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day10;

use Codehulk\AdventOfCode2020\Framework\Output;
use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 10, part 1.
 */
class Part1 implements SolutionInterface
{
    /**
     * @inheritDoc
     */
    public function run(string $input, Output $output)
    {
        $adapters = array_map('intval', explode("\n", trim($input)));
        sort($adapters);
        array_unshift($adapters, 0); // Wall outlet.
        array_push($adapters, $adapters[array_key_last($adapters)] + 3); // Device adapter.

        $differences = [];
        $max = count($adapters) - 1;
        for ($i = 0; $i < $max; $i++) {
            $current = $adapters[$i];
            $next = $adapters[$i + 1];

            $difference = $next - $current;
            $differences[$difference] = ($differences[$difference] ?? 0) + 1;
        }

        return $differences[1] * $differences[3];
    }
}
