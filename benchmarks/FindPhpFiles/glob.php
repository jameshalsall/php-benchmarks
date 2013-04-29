<?php

/**
 * find all php files in specific directory
 */

include('_shared.php');

$baseDir = __DIR__;
$testFilesDir = $baseDir . DIRECTORY_SEPARATOR . 'tests';

// create files in new directory
createTestFiles($testFilesDir, array('php', 'txt', 'csv'), NUMBER_OF_FILES);


$start = microtime(true);

// search for all php files in test directory
$files = glob($testFilesDir . DIRECTORY_SEPARATOR . '*.php');

printf("Time Taken: %f seconds \n", microtime(true) - $start);
printf("Memory Usage: %f MB \n\n", memory_get_peak_usage() / 1024 / 1024);

// clean up
cleanupTestFiles($testFilesDir, array('php', 'txt', 'csv'), NUMBER_OF_FILES);
