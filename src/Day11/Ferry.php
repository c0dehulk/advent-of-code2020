<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day11;

/**
 * Ferry
 */
class Ferry
{
    private array $seats;

    /** @var int */
    private $lastRow;

    /** @var int */
    private $lastColumn;

    public function __construct(array $seats)
    {
        $this->seats = $seats;
        $this->lastRow = array_key_last($seats);
        $this->lastColumn = array_key_last($seats[0]);
    }

    public function seat(): int
    {
        $changes = 0;
        $newSeats = [];
        for ($row = 0; $row <= $this->lastRow; $row++) {
            if (!isset($newSeats[$row])) {
                $newSeats[$row] = [];
            }
            for ($column = 0; $column <= $this->lastColumn; $column++) {
                $seat = $this->seats[$row][$column];

                $newSeats[$row][$column] = $seat;

                // Ignore the floor.
                if ($seat === '.') {
                    continue;
                }

                $adjacent = '';
                $adjacent .= $this->seats[$row - 1][$column - 1] ?? null;
                $adjacent .= $this->seats[$row - 1][$column] ?? null;
                $adjacent .= $this->seats[$row - 1][$column + 1] ?? null;
                $adjacent .= $this->seats[$row][$column - 1] ?? null;
                $adjacent .= $this->seats[$row][$column + 1] ?? null;
                $adjacent .= $this->seats[$row + 1][$column - 1] ?? null;
                $adjacent .= $this->seats[$row + 1][$column] ?? null;
                $adjacent .= $this->seats[$row + 1][$column + 1] ?? null;
                $adjacentCount = substr_count($adjacent, '#');

                if ($seat === 'L' && $adjacentCount === 0) {
                    $newSeats[$row][$column] = '#';
                    $changes++;
                } elseif ($seat === '#' && $adjacentCount >= 4) {
                    $newSeats[$row][$column] = 'L';
                    $changes++;
                }
            }
        }
        $this->seats = $newSeats;

        return $changes;
    }

    public function getSeatMap(): string {
        $map = '';
        foreach ($this->seats as $row) {
            $map .=  implode('', $row) . "\n";
        }
        return $map;
    }

    public function getOccupiedSeats(): int {
        return array_reduce(
            $this->seats,
            fn($carry, $row) => $carry + count(array_keys($row, '#')),
            0
        );
    }
}
