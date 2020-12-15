<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day12;

use Codehulk\AdventOfCode2020\Framework\Output;
use PHPUnit\Framework\TestCase;

/**
 * (Describe test requirements for class)
 */
class Part1Test extends TestCase
{
    public function testRun(): void {
        $input = <<<INPUT
F10
N3
F7
R90
F11
INPUT;


        $solution = new Part1();
        $output = $solution->run($input, $this->createMock(Output::class));
        self::assertSame(25, $output);

    }

    /**
     * (Describe circumstances and expected behaviour of test case)
     *
     * @dataProvider dataRotate
     */
    public function testRotate(string $current, string $direction, int $angle, string $expected): void
    {
        $solution = new Part1();
        $output = $solution->rotate($current, $direction, $angle);
        self::assertSame($expected, $output);
    }

    /**
     * Data provider.
     *
     * @return mixed[]
     */
    public function dataRotate(): array
    {
        return [
            'Right 90'  => ['E', 'R', 90, 'S'],
            'Right 180' => ['E', 'R', 180, 'W'],
            'Right 360' => ['E', 'R', 360, 'E'],
            'Right 450' => ['E', 'R', 450, 'S'],
            'Left 180'  => ['E', 'L', 180, 'W'],
        ];
    }
}
