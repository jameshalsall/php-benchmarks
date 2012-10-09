<?php

$start = microtime(true);

$objects = 1000;
$max = $objects;

$rawObjects = array();
$storage = array();

while ($max) {
    $object = getSimpleObject($max);
    $storage[spl_object_hash($object)] = $object;
    $rawObjects[] = $object;
    $max--;
}

foreach ($rawObjects as $rawObject) {
    array_key_exists(spl_object_hash($object), $storage);
}

function getSimpleObject($modifier) {

    $object = new stdClass();
    $object->propertyString = 'simpleString' . $modifier;
    $object->propertyArray = array($modifier + 1, $modifier + 2, $modifier + 3, 'string');
    $object->propertyBool = ($modifier % 2 === 0) ? true : false;
    $object->propertyInt = $modifier;
    $object->propertyObject = clone $object;

    return $object;
}

printf("Time Taken: %f seconds \n", microtime(true) - $start);
printf("Memory Usage: %f MB \n\n", memory_get_peak_usage() / 1024 / 1024);