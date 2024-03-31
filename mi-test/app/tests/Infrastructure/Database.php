<?php
namespace App\Infrastructure;

class Database
{
    private \PDO $connection;

    public function __construct(string $host, string $username, string $password, string $dbname)
    {
        $dsn = "mysql:host=$host;dbname=$dbname";
        $this->connection = new \PDO($dsn, $username, $password);
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    }

    public function getConnection(): \PDO
    {
        return $this->connection;
    }

    public function createTable(string $tableName, array $fields): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS $tableName (";
        foreach ($fields as $field => $type) {
            $sql .= "$field $type, ";
        }
        $sql = rtrim($sql, ', ') . ")";
        $this->connection->exec($sql);
    }

    public function insert(string $tableName, array $data): void
    {
        $fields = implode(', ', array_keys($data));
        $values = implode(', ', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO $tableName ($fields) VALUES ($values)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(array_values($data));
    }

    public function delete(string $tableName, array $conditions): void
    {
        $whereClause = '';
        foreach ($conditions as $field => $value) {
            $whereClause .= "$field = ? AND ";
        }
        $whereClause = rtrim($whereClause, 'AND ');

        $sql = "DELETE FROM $tableName WHERE $whereClause";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute(array_values($conditions));
    }

    public function dropTable(string $tableName): void
    {
        $sql = "DROP TABLE IF EXISTS $tableName";
        $this->connection->exec($sql);
    }
}
