<?php

namespace Solarsnowfall\DB;

class MySQLStatement implements StatementInterface
{
    /**
     * @var \mysqli_stmt
     */
    protected \mysqli_stmt $statement;

    /**
     * @param MySQLConnection $connection
     * @param string $query
     */
    public function __construct(MySQLConnection $connection, string $query)
    {
        $this->statement = new \mysqli_stmt($connection->getConnection(), $query);
    }

    /**
     * @return int
     */
    public function affectedRows(): int
    {
        return $this->statement->affected_rows;
    }

    /**
     * @param array $params
     * @param string|null $types
     * @return bool
     */
    public function bindParams(array $params, string $types = null): bool
    {
        if ($types === null)
            foreach ($params as $param)
                $types .= $this->guessParamType($param);

        $args = (array) $types;

        foreach (array_keys($params) as $key)
            $args[] = &$params[$key];

        return call_user_func_array(array($this->statement, 'bind_param'), $args);
    }

    /**
     * @param ...$var
     * @return bool
     */
    public function bindResult(&...$var): bool
    {
        return call_user_func_array(array($this->statement, 'bind_result'), $var);
    }

    /**
     * @param mixed $result
     * @return bool
     */
    public function bindResultArray(&$result): bool
    {
        $params = array();

        $meta = $this->statement->result_metadata();

        while ($field = $meta->fetch_field())
            $params[] = &$result[$field->name];

        return call_user_func_array(array($this, 'bindResult'), $params);
    }

    /**
     * @return bool
     */
    public function close(): bool
    {
        return $this->statement->close();
    }

    /**
     * @return int
     */
    public function errorCode(): int
    {
        return $this->statement->errno;
    }

    /**
     * @return string
     */
    public function errorMessage(): string
    {
        return $this->statement->error;
    }

    /**
     * @param array $params
     * @param string|null $types
     * @return bool
     */
    public function execute(array $params = [], ?string $types = null): bool
    {
        if (!empty($params))
            $this->bindParams($params, $types);

        return $this->statement->execute();
    }

    /**
     * @return bool|null
     */
    public function fetch(): ?bool
    {
        return $this->statement->fetch();
    }

    /**
     * @return array
     */
    public function fetchAllAssoc(): array
    {
        $row = $rows = [];

        $this->bindResultArray($result);

        while ($this->fetch())
        {
            foreach ($result as $key => $val)
                $row[$key] = $val;

            $rows[] = $row;
        }

        return $rows;
    }

    /**
     * @return array|null
     */
    public function fetchAssoc(): array
    {
        $row = [];

        $this->bindResultArray($result);

        if (!$this->fetch())
            return $row;

        foreach ($result as $key => $val)
            $row[$key] = $val;

        return $row;
    }

    /**
     * @return \mysqli_stmt
     */
    public function getStatement(): \mysqli_stmt
    {
        return $this->statement;
    }

    /**
     * @return int
     */
    public function numRows(): int
    {
        return $this->statement->num_rows;
    }

    /**
     * @param $param
     * @return string
     */
    protected function guessParamType($param): string
    {
        if (ctype_digit((string) $param))
            return 'i';

        if (is_numeric($param))
            return 'f';

        return 's';
    }
}