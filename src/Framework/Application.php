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
        $output = new Output();
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
                $input->getInput($day),
                $output,
            );
        } catch (Throwable $e) {
            $output->writeLn('Fatal Error!');
            $output->writeln($e);
            $output->writeln($e->getMessage());
            $output->writeln($e->getFile() . ':' . $e->getLine());
            return 1;
        }

        $output->writeValues('Answer', $answer);
        return 0;
    }
}
