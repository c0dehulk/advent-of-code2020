<?php
declare(strict_types = 1);

use Codehulk\AdventOfCode2020\Framework\Application;

ini_set('display_errors', '1');
error_reporting(E_ALL);
chdir(__DIR__ . '/..');
require_once 'vendor/autoload.php';

[$day, $part] = explode('.', $argv[1]);
$day = (int) $day;
$part = (int) $part;

$app = new Application(__DIR__ . '/..');
$app->runSolution($day, $part);
