<?php

$fileHandle = opendir(__DIR__);

if (! $fileHandle) {
    throw new Exception('Can not read directory');
}

$thisFilename = basename(__FILE__);

while (false !== ($file = readdir($fileHandle))) {
    // Currently ignores sub-directories, may be beneficial to scan through them too
    if ($file == $thisFilename || substr($file, 0, 1) == '.' || is_dir($file)) {
        continue;
    }

    echo $file . PHP_EOL;
    echo str_repeat('-', strlen($file)) . PHP_EOL . PHP_EOL;

    echo shell_exec('php ' . __DIR__ . DIRECTORY_SEPARATOR . $file) . PHP_EOL;
}
