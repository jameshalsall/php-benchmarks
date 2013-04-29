<?php

$start = microtime(true);

$elements = 10000;
$max = $elements;
$array = array();

while ($max) {
    $array[] = $max--;
}

$arrayObject = SplFixedArray::fromArray($array);

$maxLookUps = 2000;
while ($maxLookUps) {
    $arrayObject->offsetExists(rand(0, $elements));
    $maxLookUps--;
}

printf("Time Taken: %f seconds \n", microtime(true) - $start);
printf("Memory Usage: %f MB \n\n", memory_get_peak_usage() / 1024 / 1024);
