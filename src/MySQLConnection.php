<?php

namespace Solarsnowfall\DB;

class MySQLConnection implements ConnectionInterface
{
    /**
     * @var \mysqli
     */
    protected \mysqli $connection;

    /**
     * @param string $host
     * @param string $user
     * @param string $password
     * @param string $database
     * @param int|null $port
     * @param string|null $socket
     */
    public function __construct(string $host, string $user, string $password, string $database, ?int $port = null, ?string $socket = null)
    {
        $port = $port ?? ini_get('mysqli.default_port');

        $socket = $socket ?? ini_get('mysqli.default_socket');

        $this->connection = new \mysqli($host, $user, $password, $database, $port, $socket);
    }

    /**
     * @return int
     */
    public function affectedRows(): int
    {
        return $this->connection->affected_rows;
    }

    /**
     * @param int $flags
     * @param string|null $name
     * @return bool
     */
    public function beginTransaction(int $flags = 0, ?string $name = null): bool
    {
        return $this->connection->begin_transaction($flags, $name);
    }

    /**
     * @return bool
     */
    public function close(): bool
    {
        return $this->connection->close();
    }

    /**
     * @param int $flags
     * @param string|null $name
     * @return bool
     */
    public function commit(int $flags = 0, ?string $name = null): bool
    {
        return $this->connection->commit($flags, $name);
    }

    /**
     * @return int
     */
    public function errorCode(): int
    {
        return $this->connection->errno;
    }

    /**
     * @return string
     */
    public function errorMessage(): string
    {
        return $this->connection->error;
    }

    /**
     * @param string $query
     * @param array $params
     * @param string|null $types
     * @return array
     */
    public function fetchAllAssoc(string $query, array $params = [], ?string $types = null): array
    {
        $statement = $this->prepare($query);

        $statement->execute($params, $types);

        return $statement->fetchAllAssoc();
    }

    /**
     * @param string $query
     * @param array $params
     * @param string|null $types
     * @return array
     */
    public function fetchAssoc(string $query, array $params = [], ?string $types = null): array
    {
        $statement = $this->prepare($query);

        $statement->execute($params, $types);

        return $statement->fetchAssoc();
    }

    /**
     * @return \mysqli
     */
    public function getConnection(): \mysqli
    {
        return $this->connection;
    }

    /**
     * @return int|string
     */
    public function insertId()
    {
        return $this->connection->insert_id;
    }

    /**
     * @return bool
     */
    public function ping(): bool
    {
        return $this->connection->ping();
    }

    /**
     * @param string $query
     * @return MySQLStatement
     */
    public function prepare(string $query): MySQLStatement
    {
        return new MySQLStatement($this, $query);
    }

    /**
     * @param int $flags
     * @return bool
     */
    public function refresh(int $flags): bool
    {
        return $this->connection->refresh($flags);
    }

    /**
     * @param int $flags
     * @param string|null $name
     * @return bool
     */
    public function rollback(int $flags = 0, ?string $name = null): bool
    {
        return $this->rollback($flags, $name);
    }
}
