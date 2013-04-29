#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

use Benchmarks\Compare\CompareApplication;

$benchmarksFolder = __DIR__ . DIRECTORY_SEPARATOR . 'benchmarks';

$application = new CompareApplication($benchmarksFolder);
$application->run();
