<?php

namespace Solarsnowfall\DB;

use http\Encoding\Stream\Deflate;
use Solarsnowfall\Reflection\SingletonFactory;

abstract class DBConnection extends SingletonFactory
{
    const CLASS_NAME = null;

    /**
     * @var MySQLConnection[]
     */
    protected static array $objects = [];

    /**
     * @return array
     */
    public static function defaultInstanceParams()
    {
        return include '../../../config/db.conf.php';
    }

    /**
     * @param array|null $params
     * @return MySQLConnection|null
     * @throws \Exception
     */
    public static function get(array $params = null): ?ConnectionInterface
    {
        return parent::get($params);
    }

    /**
     * @param array $params
     * @return MySQLConnection|null
     * @throws \Exception
     */
    public static function newInstance(array $params): ?ConnectionInterface
    {
        switch ($params['engine'])
        {
            default:
            case 'mysql':

                return new MySQLConnection(
                    $params['mysql']['host'],
                    $params['mysql']['user'],
                    $params['mysql']['password'],
                    $params['mysql']['database']
                );
        }
    }
}