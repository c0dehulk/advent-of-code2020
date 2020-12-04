<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day04;

use Codehulk\AdventOfCode2020\Framework\SolutionInterface;

/**
 * Solution for day 04, part 2.
 */
class Part2 implements SolutionInterface
{
    /**
     * @inheritDoc
     */
    public function run(string $input): string
    {
        $valid = 0;

        $required = [
            'byr' => '/^(19[2-9]\d|200[0-2])$/',
            'iyr' => '/^(201\d|2020)$/',
            'eyr' => '/^(202\d|2030)$/',
            'hgt' => '/^(1[5-8]\dcm|19[0-3]cm|59in|6\din|7[0-6]in)$/',
            'hcl' => '/^#[0-9a-f]{6}$/',
            'ecl' => '/^(amb|blu|brn|gry|grn|hzl|oth)$/',
            'pid' => '/^\d{9}$/',
        ];


        $passports = explode("\n\n", $input);
        foreach ($passports as $passport) {
            preg_match_all('/(\w+):(\S+)\s*/', $passport, $matches, PREG_SET_ORDER);

            $optional = 0;

            foreach ($matches as [,$id, $value]) {
                echo "$id = $value\n";

                if (!isset($required[$id])) {
                    $optional++;
                    continue;
                }
                if (!preg_match($required[$id], $value)) {
                    echo "Field $id failed validation with `$value`.\n";
                    continue 2;
                }
            }
            // Filter out passports with not enough fields.
            $validFieldCount = count($matches) - $optional;
            echo "Valid fields: $validFieldCount\n";
            if ($validFieldCount < 7) {
                continue;
            }
            $valid++;
        }
        return (string) $valid;
    }
}
