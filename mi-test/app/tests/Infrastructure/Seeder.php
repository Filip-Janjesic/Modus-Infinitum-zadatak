<?php

namespace App\Infrastructure;

class Seeder extends Database
{
    private array $fieldMap;

    public function __construct(string $host, string $username, string $password, string $dbname, array $fieldMap)
    {
        parent::__construct($host, $username, $password, $dbname);
        $this->fieldMap = $fieldMap;
    }

    public function importData(string $tableName, array $data): void
    {
        foreach ($data as $record) {
            $mappedRecord = [];
            foreach ($this->fieldMap as $sourceField => $targetField) {
                $mappedRecord[$targetField] = $record[$sourceField];
            }
            $this->insert($tableName, $mappedRecord);
        }
    }

    public function rollbackImport(string $tableName, int $count): void
    {
        $sql = "DELETE FROM $tableName ORDER BY id DESC LIMIT $count";
        $this->getConnection()->exec($sql);
    }
}
