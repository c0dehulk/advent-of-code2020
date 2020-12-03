<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day02;

use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 02, part 1.
 */
class Part1 implements SolutionInterface
{
    /**
     * @inheritDoc
     */
    public function run(string $input): string
    {
        $rows = array_filter(explode("\n", $input));
        $valid = 0;
        foreach ($rows as $row) {
            [$constraints, $password] = explode(': ', $row);
            preg_match('/(\d+)-(\d+) (\w+)/i', $constraints, $bits);
            [, $low, $high, $letter] = $bits;

            $count = substr_count($password, $letter);
            if ($count >= $low && $count <= $high) {
                $valid++;
            }
        }
        return (string) $valid;
    }
}
