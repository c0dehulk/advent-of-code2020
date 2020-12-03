<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Framework;

/**
 * Path
 */
class Path
{
    private string $root;

    private int $year;

    private int $day;

    private int $part;

    /**
     * Constructor.
     *
     * @param int $year
     * @param int $day
     * @param int $part
     */
    public function __construct(string $root, int $year, int $day, int $part)
    {
        $this->root = $root;
        $this->year = $year;
        $this->day = $day;
        $this->part = $part;
    }

    public function getFilename(): string
    {
        return sprintf('%1$s/Day%2$02u/Part%3$01u.php', $this->root, $this->day, $this->part);
    }


    public function getFQCN(): string
    {
        return $this->getNamespace() . "\\Part{$this->part}";
    }

    public function getNamespace(): string
    {
        return sprintf('Codehulk\\AdventOfCode%1$u\\Day%2$02u', $this->year, $this->day);
    }

    /**
     * Gets...
     *
     * @return int
     */
    public function getDay(): int
    {
        return $this->day;
    }

    /**
     * Gets...
     *
     * @return int
     */
    public function getPart(): int
    {
        return $this->part;
    }
}
