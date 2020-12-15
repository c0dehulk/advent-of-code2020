<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day11;

use Codehulk\AdventOfCode2020\Framework\Output;
use PHPUnit\Framework\TestCase;

/**
 * (Describe test requirements for class)
 */
class Part1Test extends TestCase
{
    /**
     * (Describe circumstances and expected behaviour of test case)
     *
     * @dataProvider dataPart1
     */
    public function testSomething(string $input, int $expected): void
    {
        $solution = new Part1();
        $output = $solution->run($input, $this->createMock(Output::class));
        self::assertSame($expected, $output);
    }

    /**
     * Data provider.
     *
     * @return mixed[]
     */
    public function dataPart1(): array
    {
        return [
            'Example' => [
                'input'    => <<<INPUT
L.LL.LL.LL
LLLLLLL.LL
L.L.L..L..
LLLL.LL.LL
L.LL.LL.LL
L.LLLLL.LL
..L.L.....
LLLLLLLLLL
L.LLLLLL.L
L.LLLLL.LL
INPUT,
                'expected' => 37,
            ],
        ];
    }
}
