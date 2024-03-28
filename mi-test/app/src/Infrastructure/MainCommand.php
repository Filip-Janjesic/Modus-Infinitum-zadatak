<?php

namespace App\Infrastructure;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'filter')]
class MainCommand extends Command
{
    protected function configure()
    {
        $this
            ->setDescription('Filter dataset based on provided criteria')
            ->addArgument('type', InputArgument::REQUIRED, 'Type of analysis to perform');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return Command::SUCCESS;
    }
}
