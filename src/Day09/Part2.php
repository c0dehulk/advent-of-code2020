<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day09;

use Codehulk\AdventOfCode2020\Framework\Output;
use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 09, part 2.
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
        $this->output = $output;
        $numbers = array_map('intval', explode("\n", trim($input)));

        $invalidNumber = (new Part1())->run($input, $output);

        $value = $this->findContiguousRange($numbers, $invalidNumber);
        if ($value !== null) {
            return $value;
        }

        return "Not found";
    }

    private function findContiguousRange(array $numbers, int $target): ?int
    {
        $max = count($numbers);
//        $this->output->writeValues('Searching for', $target);

        for ($start = 0; $start < $max; $start++) {
            $startValue = $numbers[$start];

            $total = $startValue;
            $smallest = $startValue;
            $largest = $startValue;

//            $this->output->writeLn("Searching from: $startValue");

            for ($end = $start + 1; $end < $max; $end++) {
                $number = $numbers[$end];

                $total += $number;
                $smallest = min($smallest, $number);
                $largest = max($largest, $number);

//                $this->output->writeValues('  +', $number, '=', $total, '?', $target);

                if ($total > $target) {
//                    $this->output->writeLn('Exceeded target; next start.');
                    break;
                }

                if ($total === $target) {
//                    $this->output->writeLn('Found target in range');
                    return $smallest + $largest;
                }
            }
        }
        return null;
    }
}
