<?php
declare(strict_types = 1);

ini_set('display_errors', '1');
error_reporting(E_ALL);
chdir(__DIR__);

$raw = file_get_contents('input');
$rows = array_filter(explode("\n", $raw));


$r1d1 = getTreesOnSlope($rows, 1, 1);
$r3d1 = getTreesOnSlope($rows, 3, 1);
$r5d1 = getTreesOnSlope($rows, 5, 1);
$r7d1 = getTreesOnSlope($rows, 7, 1);
$r1d2 = getTreesOnSlope($rows, 1, 2);

echo "Answer: ";
echo ($r1d1 * $r3d1 * $r5d1 * $r7d1 * $r1d2);
echo "\n";
exit(0);


function getTreesOnSlope($rows, $x, $y): int
{
    echo "x: $x\n";
    echo "y: $y\n";

    $right = 0;
    $down = 0;

    $treeCount = 0;
    while ($down < count($rows)) {
        echo "[$right, $down]\n";
//        echo "character: {$row[$right]}\n";

        $row = $rows[$down];
        $treeCount += ($row[$right] === '#');

        $down += $y;
        $right = ($right + $x) % strlen($row);
    }
    echo "Trees: $treeCount\n";
    return $treeCount;
}
