<?php

namespace Solarsnowfall\DB;

use Solarsnowfall\Reflection\SingletonFactory;

class DBConnection extends SingletonFactory
{
    const DEFAULT_PARAMS = [
        'host'      => 'localhost',
        'user'      => 'workout_db_ext',
        'password'  => '2L4RxEtYV_ISX=$=J)KI3(BcaaEynH7Srm1',
        'database'  => 'workout_db'
    ];

    /**
     * @param array $params
     * @return MySQLConnection
     * @throws \Exception
     */
    public static function get(array $params = self::DEFAULT_PARAMS): MySQLConnection
    {
        return self::get($params);
    }

    /**
     * @param array $params
     * @return MySQLConnection
     * @throws \Exception
     */
    public static function newInstance(array $params = self::DEFAULT_PARAMS): MySQLConnection
    {
        return self::newInstance($params);
    }
}