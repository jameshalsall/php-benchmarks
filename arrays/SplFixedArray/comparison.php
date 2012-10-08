<?php

$fileHandle = opendir(__DIR__);

if (! $fileHandle) {
    throw new Exception('Can not read directory');
}

$thisFilename = basename(__FILE__);

while (false !== ($file = readdir($fileHandle))) {
    if ($file == $thisFilename || substr($file, 0, 1) == '.') {
        continue;
    }

    echo $file . PHP_EOL;
    echo str_repeat('-', strlen($file)) . PHP_EOL . PHP_EOL;

    echo shell_exec('php ' . $file) . PHP_EOL;
}
