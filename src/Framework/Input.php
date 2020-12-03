<?php

namespace Codehulk\AdventOfCode2020\Framework;

class Input
{
    private string $path;

    /** @var Session A session. */
    private Session $session;

    /**
     * Constructor.
     *
     * @param string  $path
     * @param Session $session
     */
    public function __construct(string $path, Session $session)
    {
        $this->path = $path;
        $this->session = $session;
    }

    /**
     * Gets a puzzle input.
     *
     * @param int $day A day identifier.
     *
     * @return string The raw puzzle input.
     */
    public function getInput(int $day): string
    {
        $path = $this->path . "/{$day}.input";
        if (!file_exists($path)) {
            $this->downloadInput($day, $path);
        }
        return file_get_contents($path);
    }

    /**
     * Downloads a puzzle input from adventofcode.com
     *
     * @param int    $day A day identifier.
     * @param string $path
     *
     * @return void
     */
    private function downloadInput(int $day, string $path): void
    {
        $url = "https://adventofcode.com/2020/day/{$day}/input";
        $context = stream_context_create(
            ['http' => ['header' => "Cookie: session={$this->session->getId()}\r\n"]]
        );

        $headers = get_headers($url, 1, $context);
        [, $responseCode,] = explode(' ', $headers[0]);
        if ($responseCode !== '200') {
            throw new \RuntimeException("Failed to download input for day {$day}. Responded with {$responseCode}.");
        }

        $source = fopen($url, 'r', false, $context);
        $target = fopen($path, 'w');
        stream_copy_to_stream($source, $target);
        fclose($source);
        fclose($target);
    }
}
