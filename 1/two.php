<?php
declare(strict_types = 1);

ini_set('display_errors', '1');
error_reporting(E_ALL);
chdir(__DIR__);

$raw = file_get_contents('input.txt');
$numbers = array_filter(explode("\n", $raw));
sort($numbers);
$last = count($numbers) - 1;

for ($x = 0; $x <= $last; $x++) {
    for ($y = 0; $y <= $last; $y++) {
        for ($z = 0; $z <= $last; $z++) {
            if ($numbers[$x] + $numbers[$y] + $numbers[$z] == 2020) {
                echo ($numbers[$x] * $numbers[$y] * $numbers[$z]) . "\n";
                exit(0);
            }
        }
    }
}
echo "Failed to find number.\n";
exit(1);
