<?php
declare(strict_types = 1);

namespace Codehulk\AdventOfCode2020\Framework;

/**
 * Output
 */
class Output
{
    /**
     * Writes several values to stdout, followed by a newline.
     *
     * @param mixed $values A value.
     *
     * @return void
     */
    public function writeValues(...$values): void
    {
        foreach ($values as $value) {
            $this->write($value);
            echo '   ';
        }
        echo PHP_EOL;
    }

    /**
     * Writes a value to stdout, followed by a newline.
     *
     * @param mixed $value A value.
     *
     * @return void
     */
    public function writeLn($value): void
    {
        $this->write($value);
        echo PHP_EOL;
    }

    /**
     * Writes a value to stdout.
     *
     * @param mixed $value A value.
     *
     * @return void
     */
    public function write($value): void
    {
        echo $this->format($value);
    }

    /**
     * Formats a value into a string.
     *
     * @param mixed $value A value.
     *
     * @return string
     */
    private function format($value): string
    {
        switch (gettype($value)) {
            case 'boolean':
                return ($value ? '{true}' : '{false}');
            case 'integer':
            case 'double':
                return (string) $value;
            case 'string':
                return $value;
            case 'array':
                return $this->formatArray($value);
            case 'object':
                return '{object:' . get_class($value) . '}';
            case 'resource':
            case 'resource (closed)':
                return '{resource}';
            case 'NULL':
                return '{null}';
            case 'unknown type':
            default:
                return '{unknown}';
        }
    }

    /**
     * Formats an array into a string.
     *
     * @param array $values An array.
     *
     * @return string
     */
    private function formatArray(array $values): string
    {
        $formatted = array_map([$this, 'format'], $values);
        return '[' . implode(', ', $formatted) . ']';
    }
}
