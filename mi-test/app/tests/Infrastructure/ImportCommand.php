<?php

namespace App\Infrastructure;

class ImportCommand
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function execute(string $type, array $data): void
    {
        switch ($type) {
            case 'all':
                $this->importAll($data);
                break;
            case 'criteria1':
                $this->importByCriteria1($data);
                break;
            case 'criteria2':
                $this->importByCriteria2($data);
                break;
            default:
                $this->handleInvalidArgument();
                break;
        }
    }

    private function importAll(array $data): void
    {
        echo "Importing all rows...\n";
        $this->insertDataIntoDatabase($data);
    }

    private function importByCriteria1(array $data): void
    {
        echo "Importing rows based on criteria 1...\n";
        $filteredData = array_filter($data, function($row) {
            return $row['age'] > 20 && $row['age'] < 60;
        });
        $this->insertDataIntoDatabase($filteredData);
    }

    private function importByCriteria2(array $data): void
    {
        echo "Importing rows based on criteria 2...\n";
        $filteredData = array_filter($data, function($row) {
            return $row['location'] === 'London';
        });
        $this->insertDataIntoDatabase($filteredData);
    }

    private function handleInvalidArgument(): void
    {
        echo "Invalid type argument. Please specify a valid import criteria.\n";
    }

    private function insertDataIntoDatabase(array $data): void
    {
        foreach ($data as $row) {
            $this->database->insert('your_table_name', $row);
        }
    }
}
