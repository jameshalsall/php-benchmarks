<?php

/**
 * shared functions file - ignored by comparison script
 */

function getSimpleObject($modifier) {

    $object = new stdClass();
    $object->propertyString = 'simpleString' . $modifier;
    $object->propertyArray = array($modifier + 1, $modifier + 2, $modifier + 3, 'string');
    $object->propertyBool = ($modifier % 2 === 0) ? true : false;
    $object->propertyInt = $modifier;
    $object->propertyObject = clone $object;

    return $object;
}