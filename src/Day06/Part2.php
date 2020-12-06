<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day06;

use Codehulk\AdventOfCode2020\Framework\Output;
use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 06, part 2.
 */
class Part2 implements SolutionInterface
{
    /**
     * @inheritDoc
     */
    public function run(string $input, Output $output)
    {
        $total = 0;
        $groups = explode("\n\n", trim($input));
        foreach ($groups as $group) {
            $group = trim($group) . "\n";
            $answers = count_chars($group, 1);
            $numberOfPeople = $answers[ord("\n")];
            $fullAnswers = count(array_keys($answers, $numberOfPeople)) - 1;
            $total += $fullAnswers;
        }
        return $total;
    }
}
