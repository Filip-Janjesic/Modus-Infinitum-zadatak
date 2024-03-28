<?php

namespace App\Infrastructure;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'filter')]
class MainCommand extends Command
{
    use Filter; 

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $type = $input->getArgument('type');
        $data = []; 
        switch ($type) {
            case 'age':
                $filteredData = $this->filterByAge($data);
                break;
        }
        $output->writeln('Analysis results:');
        $output->writeln(print_r($filteredData, true));

        return Command::SUCCESS;
    }
}
