<?php

/**
 * shared functions file - ignored by comparison script
 **/

define('NUMBER_OF_ITERATIONS', 100000);

class StaticClassMagic
{
    public static function __callStatic($functionName, array $parameters = array())
    {
        $instance = new self();
        $instance->myFunction();
    }

    public function myFunction()
    {
        $a = 1;
        $b = 2;
        $c = $a + $b;
    }
}

class StaticClassDefined
{
    public static function doSomething()
    {
        $a = 1;
        $b = 2;
        $c = $a + $b;
    }
}
