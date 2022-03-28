<?php

namespace Solarsnowfall\DB;

use Solarsnowfall\Reflection\SingletonFactory;

class DBConnection extends SingletonFactory
{
    const CLASS_NAME = '\\Solarsnowfall\\DB\\MySQLConnection';

    const DEFAULT_PARAMS = [
        'host'      => 'localhost',
        'user'      => 'workout_db_ext',
        'password'  => '2L4RxEtYV_ISX=$=J)KI3(BcaaEynH7Srm1',
        'database'  => 'workout_db'
    ];

    /**
     * @var MySQLConnection[]
     */
    protected static array $objects = [];

    /**
     * @param array $params
     * @return MySQLConnection|null
     * @throws \Exception
     */
    public static function get(array $params = self::DEFAULT_PARAMS): ?MySQLConnection
    {
        return parent::get($params);
    }

    /**
     * @param array $params
     * @return MySQLConnection|null
     * @throws \Exception
     */
    public static function newInstance(array $params = self::DEFAULT_PARAMS): ?MySQLConnection
    {
        $params = static::DEFAULT_PARAMS;

        return new MySQLConnection(
            $params['host'],
            $params['user'],
            $params['password'],
            $params['database']
        );
    }
}