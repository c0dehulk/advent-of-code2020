<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Framework;

/**
 * Templater
 */
class Templater implements LoaderInterface
{
    private string $templatePath;

    /**
     * Constructor.
     *
     * @param string $templatePath
     */
    public function __construct(string $templatePath)
    {
        $this->templatePath = $templatePath;
    }


    public function getSolution(Path $path): SolutionInterface
    {
        // Build the solution class from the template.
        $contents = file_get_contents($this->templatePath);
        $contents = str_replace('%%DAY%%', sprintf('%1$02u', $path->getDay()), $contents);
        $contents = str_replace('%%PART%%', $path->getPart(), $contents);

        // Store it.
        $folder = dirname($path->getFilename());
        if (!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }
        file_put_contents($path->getFilename(), $contents);

        // Load the solution.
        require_once $path->getFilename();
        $fqcn = $path->getFQCN();
        return new $fqcn;
    }
}
