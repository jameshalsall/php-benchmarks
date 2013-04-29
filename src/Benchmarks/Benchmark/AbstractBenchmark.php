<?php
/**
 * Benchmark
 */

namespace Benchmarks\Benchmark;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * Abstract benchmark
 *
 * @package Benchmarks\Benchmark
 * @author  Mark Wilson <mark@89allport.co.uk>
 */
abstract class AbstractBenchmark
{
    /**
     * Get the description of what the benchmark will do
     *
     * @return string
     */
    abstract public function getDescription();

    /**
     * Get the available methods for this benchmark
     *
     * @return array
     */
    abstract public function getMethods();

    /**
     * Get the number of executions for each method
     *
     * @return @void
     */
    abstract public function getNumberOfExecutions();

    /**
     * Number of times to execute
     *
     * @var int $numberOfExecutions
     */
    private $numberOfExecutions;

    /**
     * Output interface
     *
     * @var OutputInterface $output
     */
    private $output;

    /**
     * Initialise the benchmark with the output interface injected
     *
     * @param OutputInterface $output Output interface
     */
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * Start the comparison
     *
     * @return void
     */
    public function start()
    {
        $output = $this->getOutput();

        $methods = $this->getMethods();

        foreach ($methods as $method) {
            $output->writeln('Executing method "' . $method . '" ...');

            /** @var \Benchmarks\Benchmark\AbstractBenchmarkMethod $instance */
            $instance = new $method($this->getNumberOfExecutions());

            $instance->run();

            $output->writeln('Time taken  : ' . $instance->getDuration() . ' ms');
            $output->writeln('Memory usage: ' . $instance->getMemoryUsage() . ' bytes');

            $output->writeln('');
        }
    }

    /**
     * Set the number of executions for each method
     *
     * @return int
     */
    protected function setNumberOfExecutions()
    {
        return $this->numberOfExecutions;
    }

    /**
     * Get the output interface
     *
     * @return OutputInterface
     */
    public function getOutput()
    {
        return $this->output;
    }
}