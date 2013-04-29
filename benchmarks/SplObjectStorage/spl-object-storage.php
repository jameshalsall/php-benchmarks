<?php

include '_shared.php';

$start = microtime(true);

$objects = 1000;
$max = $objects;

$rawObjects = array();
$storage = new SplObjectStorage();

while ($max) {
    $object = getSimpleObject($max);
    $storage->attach($object);
    $rawObjects[] = $object;
    $max--;
}

foreach ($rawObjects as $rawObject) {
    isset($storage[$rawObject]);
}

printf("Time Taken: %f seconds \n", microtime(true) - $start);
printf("Memory Usage: %f MB \n\n", memory_get_peak_usage() / 1024 / 1024);
