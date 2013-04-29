<?php

/**
 * Search boolean parameters
 */

include('_shared.php');

$start = microtime(true);

for ($i = 0; $i < NUMBER_OF_ITERATIONS; $i++) {
    $options = 16 | 2;

    $option1 = $options & 1;
    $option2 = $options & 2;
    $option3 = $options & 4;
    $option4 = $options & 8;
    $option5 = $options & 16;
}

printf("Time Taken: %f seconds \n", microtime(true) - $start);
printf("Memory Usage: %f MB \n\n", memory_get_peak_usage() / 1024 / 1024);
