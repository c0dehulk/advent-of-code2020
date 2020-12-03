<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Framework;

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

    public function runSolution(int $day, int $part)
    {
        $path = new Path($this->path . '/src', 2020, $day, $part);

        $loader = new Loader(
            new Templater($this->path . '/resources/solution.template.php')
        );
        $solution = $loader->getSolution($path);


        $input = new Input(
            $this->path . '/data',
            new Session($this->path . '/session.key')
        );

        $answer = $solution->run(
            $input->getInput($day)
        );

        echo "Answer: {$answer}\n";
        exit(0);
    }
}
