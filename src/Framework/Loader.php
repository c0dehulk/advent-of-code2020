<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Framework;

/**
 * Loader
 */
class Loader
{

    /**
     * @var Templater
     */
    private Templater $templater;

    /**
     * Constructor.
     *
     * @param Templater $templater
     *
     */
    public function __construct(Templater $templater)
    {
        $this->templater = $templater;
    }

    public function getSolution(Path $path): SolutionInterface
    {
        if (!class_exists($path->getFQCN())) {
            return $this->templater->getSolution($path);
        }
        $fqcn = $path->getFQCN();
        $solution = new $fqcn;
        if (!$solution instanceof SolutionInterface) {
            throw new \RuntimeException("Solution for {$path->getDay()}.{$path->getPart()} found, but has incorrect interface.");
        }
        return $solution;
    }
}
