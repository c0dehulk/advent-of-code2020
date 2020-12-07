<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Day07;

/**
 * Bag
 */
class Bag
{
    private string $id;

    /**
     * @var array
     */
    private array $bags = [];

    /**
     * Constructor.
     *
     * @param string $id
     *
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function addBag(Bag $bag, int $quantity)
    {
        $this->bags[] = [$bag, $quantity];
    }

    /**
     * Gets...
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    public function contains(string $id): bool
    {
        /** @var Bag $bag
         * @var int $quantity
         */
        foreach ($this->bags as [$bag, $quantity]) {
            if ($bag->getId() === $id) {
                return true;
            }
            if ($bag->contains($id)) {
                return true;
            }
        }
        return false;
    }

    public function getSize(): int
    {
        return array_reduce(
            $this->bags,
            function (int $carry, array $pair) {
                return $carry + ($pair[0]->getSize() * $pair[1]);
            },
            1
        );
    }
}
