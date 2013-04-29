<?php

$start = microtime(true);

$elements = 10000;
$max = $elements;
$array = array();

while ($max) {
    $array[] = $max--;
}

$maxLookUps = 2000;
while ($maxLookUps) {
    in_array(rand(0, $elements), $array);
    $maxLookUps--;
}

printf("Time Taken: %f seconds \n", microtime(true) - $start);
printf("Memory Usage: %f MB \n\n", memory_get_peak_usage() / 1024 / 1024);
