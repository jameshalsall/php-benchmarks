<?php
/**
 * Benchmarks
 */

namespace Benchmarks\Benchmark;

use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\Stopwatch\StopwatchEvent;

/**
 * Abstract benchmark method
 *
 * @package Benchmarks\Benchmark
 * @author  Mark Wilson <mark@89allport.co.uk>
 */
abstract class AbstractBenchmarkMethod
{
    /**
     * Get the loop code
     *
     * @return string
     */
    abstract public function getLoopCode();

    /**
     * Number of executions
     *
     * @var int $numberOfExecutions
     */
    private $numberOfExecutions;

    /**
     * Executable code
     *
     * @var string $executableCode
     */
    private $loopCode;
    /**
     * Set up code
     *
     * @var string $setUpCode
     */
    private $setUpCode;
    /**
     * Clean up code
     *
     * @var string $cleanUpCode
     */
    private $cleanUpCode;

    /**
     * Stopwatch event
     *
     * @var StopwatchEvent $stopwatchEvent
     */
    private $stopwatchEvent;
    /**
     * Stopwatch instance
     *
     * @var Stopwatch $stopwatch
     */
    private $stopwatch;

    /**
     * Initialise the profiling and set the code scope and loop
     *
     * @param int $numberOfExecutions Number of times to execute the loop
     *
     * @return AbstractBenchmarkMethod
     */
    public function __construct($numberOfExecutions)
    {
        $this->stopwatch          = new Stopwatch();

        $this->loopCode       = $this->getLoopCode();
        $this->setUpCode      = $this->getSetUpCode();
        $this->cleanUpCode    = $this->getCleanUpCode();

        $this->numberOfExecutions = $numberOfExecutions;
    }

    /**
     * Get the set up code
     *
     * @return string
     */
    public function getSetUpCode()
    {
        return '';
    }

    /**
     * Get the loop code
     *
     * @return string
     */
    public function getCleanUpCode()
    {
        return '';
    }

    /**
     * Start the code looping
     *
     * @return void
     */
    public function run()
    {
        eval($this->setUpCode);

        $this->stopwatch->start('execution');

        for ($executionCount = 0; $executionCount < $this->numberOfExecutions; $executionCount++) {
            eval($this->loopCode);
        }

        $this->stopwatchEvent = $this->stopwatch->stop('execution');
        eval($this->cleanUpCode);
    }

    /**
     * Get duration of executions in milliseconds
     *
     * @return int
     */
    public function getDuration()
    {
        return $this->stopwatchEvent->getDuration();
    }

    /**
     * Get the memory usage in bytes
     *
     * @return int
     */
    public function getMemoryUsage()
    {
        return $this->stopwatchEvent->getMemory();
    }
}