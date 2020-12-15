<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day15;

use Codehulk\AdventOfCode2020\Framework\Output;
use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 15, part 1.
 */
class Part1 implements SolutionInterface
{
    /**
     * @inheritDoc
     */
    public function run(string $input, Output $output)
    {
        $raw = explode(',', $input);

        // Modify the raw array to 1-based.
        $numbers = [];
        foreach ($raw as $id => $number) {
            $turnId = $id + 1;
            $numbers[$turnId] = (int) $number;
            $output->writeValues('Turn', $turnId, 'Number', $numbers[$turnId]);
        }

        $firstTurnId = count($numbers) + 1;
        for ($turnId = $firstTurnId; $turnId <= 2020; $turnId++) {
            $lastNumber = $numbers[$turnId - 1];

            $previousTurnIds = array_keys($numbers, $lastNumber);

            // Number not seen before last turn.
            if (count($previousTurnIds) === 1) {
                $numbers[$turnId] = 0;
                $output->writeValues('Turn', $turnId, 'Number', $numbers[$turnId]);
                continue;
            }

            // Number seen before.
            if (count($previousTurnIds) > 1) {
                $lastSpokenTurnId = array_pop($previousTurnIds);
                $priorSpokenTurnId = array_pop($previousTurnIds);
                $numbers[$turnId] = $lastSpokenTurnId - $priorSpokenTurnId;
                $output->writeValues('Turn', $turnId, 'Number', $numbers[$turnId]);
                continue;
            }
        }

        return $numbers[2020];
    }
}
