<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Framework;

/**
 * Loader
 */
interface LoaderInterface
{
    public function getSolution(Path $path): SolutionInterface;
}
