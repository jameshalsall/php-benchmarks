<?php
/**
 * Benchmarks
 */

namespace Benchmarks\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

/**
 * Command for comparing benchmark scripts
 *
 * @package Benchmarks\Command
 * @author  Mark Wilson <mark@89allport.co.uk>
 */
class CompareCommand extends Command
{
    /**
     * Configure the available command
     *
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('compare')
            ->setDescription('Compare benchmarks')
            ->addArgument(
                'benchmark',
                InputArgument::REQUIRED,
                'Which benchmark should be executed?'
            );
    }

    /**
     * Run the command
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @throws \RuntimeException If unable to find the benchmark
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $benchmark = $input->getArgument('benchmark');
        $text      = 'Executing benchmark "' . $benchmark . '" ...';

        $output->writeln($text);
        $output->writeln('');

        // @todo: improve this to use a finder class?
        $directory = $this->getApplication()->getBenchmarksFolder()
            . DIRECTORY_SEPARATOR . rtrim($benchmark, DIRECTORY_SEPARATOR);

        // try opening benchmark directory
        $fileHandle = opendir($directory);
        if (! $fileHandle) {
            throw new \RuntimeException('Can not read benchmark directory');
        }

        // loop through files in directory - assumed to be more efficient than loading into an array
        // TODO: set up a benchmark to test this assumption!
        while (false !== ($file = readdir($fileHandle))) {
            // Currently ignores sub-directories, may be beneficial to scan through them too
            if (substr($file, 0, 1) == '_' || substr($file, 0, 1) == '.' || is_dir($file)) {
                continue;
            }

            $output->writeln($file);
            $output->writeln(str_repeat('-', strlen($file)));

            // execute the benchmark
            $command = 'php ' . $directory . DIRECTORY_SEPARATOR . $file;
            $process = new Process($command);
            $process->run();

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new \RuntimeException($process->getErrorOutput());
            }

            $output->write($process->getOutput());
        }

        closedir($fileHandle);
    }
}