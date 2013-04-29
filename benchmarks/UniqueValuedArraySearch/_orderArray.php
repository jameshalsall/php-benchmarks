<?php

$numberOfSearches = SEARCH_REPETITIONS;

$orderArray = array();

for ($i = 0; $i < $numberOfSearches; $i++) {
    $orderArray[$i] = mt_rand(0, UNIQUE_ARRAY_LENGTH - 1);
}

return $orderArray;
