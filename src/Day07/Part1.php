<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day07;

use Codehulk\AdventOfCode2020\Framework\Output;
use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 07, part 1.
 */
class Part1 implements SolutionInterface
{
    /**
     * @inheritDoc
     */
    public function run(string $input, Output $output)
    {
        $canContain = 0;
        foreach ($this->getTree($input) as $bag) {
            $canContain += (int) $bag->contains('shiny gold');
        }
        return $canContain;
    }

    /**
     * (Description)
     *
     * @return Bag[]
     */
    public function getTree(string $input): array {
        $rules = explode("\n", trim($input));

        //striped aqua bags contain 5 dark purple bags, 1 striped green bag, 4 mirrored coral bags.

        /** @var Bag[] $bags */
        $bags = [];

        foreach ($rules as $rule) {
            [$id,] = explode(' bags contain', $rule);

            if (!isset($bags[$id])) {
                $bags[$id] = new Bag($id);
            }
            $bag = $bags[$id];

            preg_match_all('/(\d+) (\w+ \w+) bags?,?/', $rule, $matches, PREG_SET_ORDER);
            foreach ($matches as $match) {
                [, $quantity, $childId] = $match;

                if (!isset($bags[$childId])) {
                    $bags[$childId] = new Bag($childId);
                }
                $child = $bags[$childId];

                $bag->addBag($child, intval($quantity));
            }
        }
        return $bags;
    }
}
