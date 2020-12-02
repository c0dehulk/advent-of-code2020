<?php
declare(strict_types = 1);

ini_set('display_errors', '1');
error_reporting(E_ALL);
chdir(__DIR__);

$raw = file_get_contents('input');
$rows = array_filter(explode("\n", $raw));

$valid = 0;

foreach ($rows as $row) {
    [$constraints, $password] = explode(': ', $row);
    preg_match('/(\d+)-(\d+) (\w+)/i', $constraints, $bits);
    [, $low, $high, $letter] = $bits;

    $isLow = ($password[$low -1] ?? '') === $letter;
    $isHigh = ($password[$high -1] ?? '') === $letter;

    if ($isLow xor $isHigh) {
        $valid++;
    }
}
echo $valid . "\n";
exit(0);
