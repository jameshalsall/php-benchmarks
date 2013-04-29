<?php

require '_shared.php';
$searchArray = require '_searchArray.php';
$orderToSearch = require '_orderArray.php';

$start = microtime(true);

foreach ($orderToSearch as $searchIndex) {
    $value = $searchArray[$searchIndex];

    $copyOfArray = $searchArray;
    $inArray = in_array($value, $copyOfArray);
}

printf("Time Taken: %f seconds \n", microtime(true) - $start);
printf("Memory Usage: %f MB \n\n", memory_get_peak_usage() / 1024 / 1024);
