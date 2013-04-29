<?php
/**
 * Benchmarks
 */

namespace Benchmarks\Compare;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputDefinition;
use Benchmarks\Command\CompareCommand;

/**
 * Comparison tool
 *
 * @package Benchmarks\Compare
 * @author  Mark Wilson <mark@89allport.co.uk>
 */
class CompareApplication extends Application
{
    /**
     * Benchmarks folder used in search
     *
     * @var string $benchmarksFolder
     */
    private $benchmarksFolder;

    public function __construct($benchmarksFolder)
    {
        parent::__construct();

        $this->benchmarksFolder = $benchmarksFolder;
    }

    /**
     * Gets the name of the command based on input.
     *
     * @param InputInterface $input The input interface
     *
     * @return string The command name
     */
    protected function getCommandName(InputInterface $input)
    {
        return 'compare';
    }

    /**
     * Gets the default commands that should always be available.
     *
     * @return array An array of default Command instances
     */
    protected function getDefaultCommands()
    {
        $defaultCommands = parent::getDefaultCommands();

        $defaultCommands[] = new CompareCommand();

        return $defaultCommands;
    }

    /**
     * Overridden so that the application does not expect the command name to be the first argument.
     *
     * @return InputDefinition
     */
    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();

        // clear out the normal first argument, which is the command name
        $inputDefinition->setArguments();

        return $inputDefinition;
    }

    /**
     * Get the benchmarks folder path
     *
     * @return string
     */
    public function getBenchmarksFolder()
    {
        return $this->benchmarksFolder;
    }
}
