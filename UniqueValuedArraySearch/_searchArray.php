<?php

$length = UNIQUE_ARRAY_LENGTH;

$uniqueValuedArray = array();
for ($i = 0; $i < $length; $i++) {
    $uniqueValuedArray[$i] = uniqid('', true);
}

return $uniqueValuedArray;
