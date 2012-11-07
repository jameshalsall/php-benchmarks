<?php

$start = microtime(true);

substr(sha1(time()), 0, 23);

printf("Time Taken: %f seconds \n", microtime(true) - $start);
printf("Memory Usage: %f MB \n\n", memory_get_peak_usage() / 1024 / 1024);