<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Framework;

/**
 * Session
 */
class Session
{
    private string $path;

    /**
     * Constructor.
     *
     * @param string  $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function getId(): string {
        return trim(file_get_contents($this->path) ?: '');
    }
}
