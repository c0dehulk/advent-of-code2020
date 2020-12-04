<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day04;

use Codehulk\AdventOfCode2020\Framework\Output;
use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 04, part 1.
 */
class Part1 implements SolutionInterface
{
    /**
     * @inheritDoc
     */
    public function run(string $input, Output $output)
    {
        $valid = 0;
        $required = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid'];

        $passports = explode("\n\n", $input);
        foreach ($passports as $passport) {
            preg_match_all('/(\w+):(\S+)\s*/', $passport, $matches);
            if (array_diff($required, $matches[1]) === []) {
                $valid++;
            }
        }
        return $valid;
    }
}
