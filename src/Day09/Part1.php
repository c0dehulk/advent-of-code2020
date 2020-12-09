<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day09;

use Codehulk\AdventOfCode2020\Framework\Output;
use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 09, part 1.
 */
class Part1 implements SolutionInterface
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
        $this->output = $output;

        $numbers = array_map('intval', explode("\n", trim($input)));
        $max = count($numbers);
        for ($i = 25; $i < $max; $i++) {
            $number = $numbers[$i];
//            $output->writeValues($i, $number);
            $isValid = $this->isValid($numbers, $i - 25, 25, $number);
            if (!$isValid) {
                return $number;
            }
        }
        return "Not found";
    }

    private function isValid(array $numbers, int $start, int $range, int $target): bool
    {
        $max = $start + $range;
        for ($x = $start; $x < $max; $x++) {
            for ($y = $start; $y < $max; $y++) {
                if ($x === $y) {
                    continue;
                }
//                $this->output->writeValues('x = ', $x, 'Value = ', $numbers[$x]);
//                $this->output->writeValues('y = ', $y, 'Value = ', $numbers[$y]);
//                $this->output->writeValues('target = ', $target);
                if ($numbers[$x] + $numbers[$y] === $target) {
//                    $this->output->writeLn('Found');
                    return true;
                }
            }
        }
        return false;
    }
}
