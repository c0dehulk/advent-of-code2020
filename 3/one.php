<?php
declare(strict_types = 1);

ini_set('display_errors', '1');
error_reporting(E_ALL);
chdir(__DIR__);

$raw = file_get_contents('input');
$rows = array_filter(explode("\n", $raw));


$left = 0;
$treeCount = 0;
for ($rowId = 1; $rowId < count($rows); $rowId++) {
    $row = $rows[$rowId];
    $left = ($left + 3) % strlen($row);
    echo "rowId: $rowId\n";
    echo "left: $left\n";
    echo "character: {$row[$left]}\n";
    $treeCount += ($row[$left] === '#');
}

echo $treeCount . "\n";
exit(0);
