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
use Symfony\Component\Finder\Finder;
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

        $directory = $this->getApplication()->getBenchmarksFolder()
            . DIRECTORY_SEPARATOR . rtrim($benchmark, DIRECTORY_SEPARATOR);

        $finder = new Finder();
        $finder->files()->name('*.php')->notName('_*.php')->in($directory);

        /** @var $file \Symfony\Component\Finder\SplFileInfo */
        foreach ($finder as $file) {
            $output->writeln($file->getFilename());
            $output->writeln(str_repeat('-', strlen($file)));

            // execute the benchmark
            $command = 'php ' . $file->getPathname();
            $process = new Process($command);
            $process->run();

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new \RuntimeException($process->getErrorOutput());
            }

            $output->write($process->getOutput());
        }
    }
}