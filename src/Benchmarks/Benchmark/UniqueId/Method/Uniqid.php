<?php
/**
 * Benchmarks
 */

namespace Benchmarks\Benchmark\UniqueId\Method;

use Benchmarks\Benchmark\AbstractBenchmarkMethod;

/**
 * uniqid implementation
 *
 * @package Benchmarks\Benchmark\UniqueId
 * @author  Mark Wilson <mark@89allport.co.uk>
 */
class Uniqid extends AbstractBenchmarkMethod
{
    public function getLoopCode()
    {
        return <<<EOD
substr(uniqid('', true). uniqid('', true), 0, 32);
EOD;
    }
}