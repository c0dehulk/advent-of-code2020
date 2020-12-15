<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day15;

use Codehulk\AdventOfCode2020\Framework\Output;
use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 15, part 2.
 */
class Part2 implements SolutionInterface
{
    /**
     * @inheritDoc
     */
    public function run(string $input, Output $output)
    {
        ini_set('memory_limit', '256M');
        $seekToTurnId = 30000000;

        $raw = explode(',', $input);

        // Modify the raw array to a map of numbers and the turn they were last seen on.
        $lastSeen = [];
        $previousNumber = 0;
        $previousTurnId = 0;
        foreach ($raw as $id => $number) {
            $turnId = $id + 1;
            $number = (int)$number;
            $lastSeen[$number] = $turnId;

            $previousTurnId = $turnId;
            $previousNumber = $number;
        }
        array_pop($lastSeen);

        // Iterate over the subsequent turns, seeking the answer to turn $seekToTurnId.
        while ($previousTurnId < $seekToTurnId) {
            $turnId = $previousTurnId + 1;

            if (array_key_exists($previousNumber, $lastSeen)) {
                $priorTurnId = $lastSeen[$previousNumber];
                $number = $previousTurnId - $priorTurnId;
            } else {
                $number = 0;
            }

            $lastSeen[$previousNumber] = $previousTurnId;

            if ($turnId > ($seekToTurnId - 10)) {
                $output->writeValues('Turn', $turnId, 'Number', $number);
            }

            $previousNumber = $number;
            $previousTurnId = $turnId;
        }


        return $previousNumber;
    }
}
