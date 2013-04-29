<?php

/**
 * Search boolean parameters
 */

include('_shared.php');

$start = microtime(true);

for ($i = 0; $i < NUMBER_OF_ITERATIONS; $i++) {
    $options = array(
        'option1' => true,
        'option2' => false,
        'option3' => false,
        'option4' => true,
        'option5' => false
    );

    foreach ($options as $key => $value) {
        $$key = $value;
    }
}

printf("Time Taken: %f seconds \n", microtime(true) - $start);
printf("Memory Usage: %f MB \n\n", memory_get_peak_usage() / 1024 / 1024);
