<?php

namespace Solarsnowfall\DB;

interface ConnectionInterface
{
    /**
     * @return int
     */
    public function affectedRows(): int;

    /**
     * @param int $flags
     * @param string|null $name
     * @return bool
     */
    public function beginTransaction(int $flags = 0, ?string $name = null): bool;

    /**
     * @return bool
     */
    public function close(): bool;

    /**
     * @param int $flags
     * @param string|null $name
     * @return bool
     */
    public function commit(int $flags = 0, ?string $name = null): bool;

    /**
     * @return int
     */
    public function errorCode(): int;

    /**
     * @return string
     */
    public function errorMessage(): string;

    /**
     * @param string $query
     * @param array $params
     * @param string|null $types
     * @return StatementInterface
     */
    public function execute(string $query, array $params = [], ?string $types = null): StatementInterface;

    /**
     * @return mixed
     */
    public function getConnection();

    /**
     * @return int|string
     */
    public function insertId();

    /**
     * @param string $query
     * @param array $params
     * @param string|null $types
     * @return array
     */
    public function fetchAllAssoc(string $query, array $params = [], ?string $types = null): array;

    /**
     * @param string $query
     * @param array $params
     * @param string|null $types
     * @return array
     */
    public function fetchAssoc(string $query, array $params = [], ?string $types = null): array;

    /**
     * @return string
     */
    public function getDatabase(): string;

    /**
     * @return bool
     */
    public function ping(): bool;

    /**
     * @param string $query
     * @return StatementInterface
     */
    public function prepare(string $query): StatementInterface;

    /**
     * @param int $flags
     * @return bool
     */
    public function refresh(int $flags): bool;

    /**
     * @param int $flags
     * @param string|null $name
     * @return bool
     */
    public function rollback(int $flags = 0, ?string $name = null): bool;
}