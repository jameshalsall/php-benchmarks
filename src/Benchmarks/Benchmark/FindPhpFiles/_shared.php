<?php

/**
 * shared functions file - ignored by comparison script
 **/

define('NUMBER_OF_FILES', 2000);

/**
 * create test files
 */
function createTestFiles($directory, Array $fileTypes, $numberToCreate)
{
    $directory = sanitiseDirectory($directory);

    if (!mkdir($directory)) {
        throw new Exception('Could not create test directory');
    }

    while ($numberToCreate > 0) {
        foreach ($fileTypes as $extension) {
            touch($directory . $numberToCreate . '.' . $extension);
        }

        $numberToCreate--;
    }
}

/**
 * cleanup test files
 */
function cleanupTestFiles($directory, Array $fileTypes, $numberCreated)
{
    $directory = sanitiseDirectory($directory);

    if (!is_dir($directory)) {
        throw new Exception('Could not find test directory');
    }

    while ($numberCreated > 0) {
        foreach ($fileTypes as $extension) {
            unlink($directory . $numberCreated . '.' . $extension);
        }

        $numberCreated--;
    }

    if (!rmdir($directory)) {
        throw new Exception('Could not remove test directory');
    }
}

/**
 * sanitise directory supplied
 */
function sanitiseDirectory($directory)
{
    // should this use realpath? will that work if it doesn't exist?
    return rtrim($directory, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
}
