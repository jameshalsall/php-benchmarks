<?php
/**
 * Benchmarks
 */

namespace Benchmarks\Benchmark\UniqueId;

use Benchmarks\Benchmark\AbstractBenchmark;

/**
 * Unique Id generation benchmark
 *
 * @package Benchmarks\Benchmark\UniqueId
 * @author  Mark Wilson <mark@89allport.co.uk>
 */
class UniqueId extends AbstractBenchmark
{
    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {
        return 'Check generation of unique identifiers';
    }

    /**
     * {@inheritDoc}
     */
    public function getMethods()
    {
        return array(
            __NAMESPACE__ . '\Method\Uniqid',
            __NAMESPACE__ . '\Method\HashedTimestamp'
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getNumberOfExecutions()
    {
        return 5000;
    }
}