<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Framework;

use Throwable;

/**
 * Framework
 */
class Application
{
    /**
     * Constructor.
     *
     * @param string $path
     *
     */
    public function __construct(string $path)
    {
        $this->path = realpath($path);
    }

    public function runSolution(int $day, int $part): int
    {
        try {
            $path = new Path($this->path . '/src', 2020, $day, $part);

            $loader = new Loader(
                new Templater($this->path . '/resources/solution.template.php')
            );
            $solution = $loader->getSolution($path);

            $input = new Input(
                $this->path . '/data',
                new Session($this->path . '/data/session.key')
            );

            $answer = $solution->run(
                $input->getInput($day)
            );
        } catch (Throwable $e) {
            echo "Fatal Error!\n";
            echo get_class($e) . "\n";
            echo $e->getMessage() . "\n";
            return 1;
        }

        echo "Answer: {$answer}\n";
        return 0;
    }
}
