#!/usr/bin/env php
<?php

// get command line params
if (! isset($argv[1])) {
    throw new RuntimeException('Usage: compare.php <benchmark-directory>');
}

// generate benchmarks base directory
$directory = __DIR__ . DIRECTORY_SEPARATOR . rtrim($argv[1], DIRECTORY_SEPARATOR);

// try opening benchmark directory
$fileHandle = opendir($directory);
if (! $fileHandle) {
    throw new Exception('Can not read directory');
}

// loop through files in directory - assumed to be more efficient than loading into an array
// TODO: set up a benchmark to test this assumption!
while (false !== ($file = readdir($fileHandle))) {
    // Currently ignores sub-directories, may be beneficial to scan through them too
    if (substr($file, 0, 1) == '_' || substr($file, 0, 1) == '.' || is_dir($file)) {
        continue;
    }

    echo $file . PHP_EOL;
    echo str_repeat('-', strlen($file)) . PHP_EOL . PHP_EOL;

    // execute the benchmark
    echo shell_exec('php ' . $directory . DIRECTORY_SEPARATOR . $file) . PHP_EOL;
}

closedir($fileHandle);
