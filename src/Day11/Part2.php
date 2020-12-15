<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day11;

use Codehulk\AdventOfCode2020\Framework\Output;
use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 11, part 2.
 */
class Part2 implements SolutionInterface
{
    /**
     * @inheritDoc
     */
    public function run(string $input, Output $output)
    {
        $seats = array_map(
            fn($x) => str_split($x),
            explode("\n", trim($input))
        );

        $ferry = new Ferry($seats);
        $changes = 1;
        while ($changes > 0) {
            $changes = $ferry->seatLos();
            $output->writeLn($changes);
        }
        return $ferry->getOccupiedSeats();
    }
}
