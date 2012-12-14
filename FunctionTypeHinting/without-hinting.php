<?php

include '_shared.php';

$start = microtime(true);

function dummy($object)
{
    return $object->property;
}

for ($i = 0; $i <= ITERATIONS; $i++) {
    dummy($object);
}

printf("Time Taken: %f seconds \n", microtime(true) - $start);
printf("Memory Usage: %f MB \n\n", memory_get_peak_usage() / 1024 / 1024);