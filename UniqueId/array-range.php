<?php

$start = microtime(true);

$range = array_merge(range(0, 10), range('a', 'z'));
shuffle($range);
substr(implode('', $range), 0, 23);

printf("Time Taken: %f seconds \n", microtime(true) - $start);
printf("Memory Usage: %f MB \n\n", memory_get_peak_usage() / 1024 / 1024);