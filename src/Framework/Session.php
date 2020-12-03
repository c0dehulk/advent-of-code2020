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
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function getId(): string
    {
        if (!realpath($this->path)) {
            throw new \RuntimeException("No session key set in `{$this->path}`.");
        }
        $key = trim(file_get_contents($this->path) ?: '');
        if (!$key) {
            throw new \RuntimeException("No session key set in `{$this->path}`.");
        }
        return $key;
    }
}
