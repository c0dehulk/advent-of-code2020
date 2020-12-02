<?php
declare(strict_types=1);

ini_set('display_errors', '1');
error_reporting(E_ALL);
chdir(__DIR__);

$raw = file_get_contents('input.txt');
$numbersF = array_filter(explode("\n", $raw));
sort($numbersF);
$numbersB = array_reverse($numbersF);

foreach ($numbersF as $first) {
    foreach ($numbersB as $last) {
        if ($first + $last > 2020) {
            continue;
        }
        if ($first + $last < 2020) {
            break;
        }
        if ($first + $last == 2020) {
            echo $first * $last . "\n";
            exit(0);
        }
    }
}
echo "Failed to find number.\n";
exit(1);
