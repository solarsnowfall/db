<?php

namespace Solarsnowfall\DB;

interface StatementInterface
{
    /**
     * @return int
     */
    public function affectedRows(): int;

    /**
     * @param array $params
     * @param string|null $types
     * @return bool
     */
    public function bindParams(array $params, string $types = null): bool;

    /**
     * @param ...$var
     * @return bool
     */
    public function bindResult(&...$var): bool;

    /**
     * @return int
     */
    public function errorCode(): int;

    /**
     * @return string
     */
    public function errorMessage(): string;

    /**
     * @param array $params
     * @param string|null $types
     * @return bool
     */
    public function execute(array $params = [], ?string $types = null): bool;

    /**
     * @return bool|null
     */
    public function fetch(): ?bool;

    /**
     * @return array
     */
    public function fetchAllAssoc(): array;

    /**
     * @return array
     */
    public function fetchAssoc(): array;

    /**
     * @return int
     */
    public function numRows(): int;
}