<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day10;

use Codehulk\AdventOfCode2020\Framework\Output;
use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 10, part 2.
 */
class Part2 implements SolutionInterface
{
    /** @var int[] */
    private $cache = [];

    /**
     * @inheritDoc
     */
    public function run(string $input, Output $output)
    {
        $adapters = array_map('intval', explode("\n", trim($input)));
        sort($adapters);
        array_unshift($adapters, 0); // Wall outlet.
        array_push($adapters, $adapters[array_key_last($adapters)] + 3); // Device adapter.

        return $this->countValidArrangements($adapters, 0, $output);
    }

    private function getValidArrangements(array $adapters, int $startId, Output $output): int
    {
        return $this->cache[$startId] ??= $this->countValidArrangements($adapters, $startId, $output);
    }

    private function countValidArrangements(array $adapters, int $startId, Output $output): int
    {
        $validArrangements = 0;
        $startVolt = $adapters[$startId];
        for ($n = 1; $n <= 3; $n++) {
            $nextId = $startId + $n;
            $endVolt = $adapters[$nextId] ?? null;

            $output->writeValues('sId:', $startId, 'eId:', $nextId, 'sV', $startVolt, 'eV', $endVolt);

            if ($endVolt === null) {
                $output->writeLn('End of adapters, valid arrangement');
                return 1;
            }
            if ($endVolt - $startVolt > 3) {
                $output->writeLn('Voltage difference too high');
                continue;
            }
            $validArrangements += $this->getValidArrangements($adapters, $nextId, $output);
        }
        return $validArrangements;
    }
}
