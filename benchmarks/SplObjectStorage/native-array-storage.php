<?php

include '_shared.php';

$start = microtime(true);

$objects = 1000;
$max = $objects;

$rawObjects = array();
$storage = array();

while ($max) {
    $object = getSimpleObject($max);
    $storage[] = $object;
    $rawObjects[] = $object;
    $max--;
}

foreach ($rawObjects as $rawObject) {
    in_array($object, $storage);
}

printf("Time Taken: %f seconds \n", microtime(true) - $start);
printf("Memory Usage: %f MB \n\n", memory_get_peak_usage() / 1024 / 1024);
