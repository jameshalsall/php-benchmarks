<?php

include('_shared.php');

$start = microtime(true);

for ($count = 0; $count < NUMBER_OF_GENERATIONS; $count++) {
    uniqid('', true);
}

printf("Time Taken: %f seconds \n", microtime(true) - $start);
printf("Memory Usage: %f MB \n\n", memory_get_peak_usage() / 1024 / 1024);
