<?php

$start = microtime(true);

$elements = 10000;
$max = $elements;
$array = array();

while ($max) {
    $array[] = $max--;
}

$arrayObject = SplFixedArray::fromArray($array);

$maxLookups = 2000;
while ($maxLookups) {
    $arrayObject->offsetExists(rand(0, $elements));
    $maxLookups--;
}

printf("Time Taken: %f seconds \n", microtime(true) - $start);
printf("Memory Usage: %f MB \n\n", memory_get_peak_usage() / 1024 / 1024);

