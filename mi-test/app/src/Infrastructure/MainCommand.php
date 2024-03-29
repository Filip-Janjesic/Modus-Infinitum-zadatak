<?php
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use App\Infrastructure\Filter;


#[AsCommand(name: 'filter')]
class MainCommand extends Command
{
    use Filter;

    protected function configure(): void
    {
        $this
            ->setDescription('Filter dataset based on provided criteria')
            ->addArgument('type', InputArgument::REQUIRED, 'Type of analysis to perform');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $type = $input->getArgument('type');

        
        $data = $this->loadDataset();

        switch ($type) {
            case 'age':
                $filteredData = $this->filterByAge($data);
                break;
            // Add cases for other analysis types here
        }

        $output->writeln('Analysis results:');
        $output->writeln(print_r($filteredData, true));

        return Command::SUCCESS;
    }

    private function loadDataset(): array
    {
        $jsonFilePath = 'C:/workspace/Modus-Infinitum-zadatak/mi-test/app/var/input.jsonl';
        $jsonData = file_get_contents($jsonFilePath);
        $data = explode(PHP_EOL, $jsonData);
        return array_map('json_decode', $data);
    }
}
