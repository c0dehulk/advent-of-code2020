<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day11;

use Codehulk\AdventOfCode2020\Framework\Output;
use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 11, part 1.
 */
class Part1 implements SolutionInterface
{
    /**
     * @inheritDoc
     */
    public function run(string $input, Output $output)
    {
//        $input = <<<INPUT
//L.LL.LL.LL
//LLLLLLL.LL
//L.L.L..L..
//LLLL.LL.LL
//L.LL.LL.LL
//L.LLLLL.LL
//..L.L.....
//LLLLLLLLLL
//L.LLLLLL.L
//L.LLLLL.LL
//INPUT;

        $seats = array_map(
            fn($x) => str_split($x),
            explode("\n", trim($input))
        );

        $ferry = new Ferry($seats);
        $changes = 1;
        while ($changes > 0) {
            $changes = $ferry->seat();
            $output->writeLn($changes);
        }
        return $ferry->getOccupiedSeats();
    }
}
