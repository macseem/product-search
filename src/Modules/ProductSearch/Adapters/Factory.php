<?php
namespace Macseem\Search\Modules\ProductSearch\Adapters;
use Macseem\Search\Modules\ProductSearch\Interfaces\Adapter;

/**
 * Class Factory
 * @package Macseem\Search\Modules\ProductSearch\Adapters
 */
class Factory
{
    private static $_cache;

    public static function getInstance($type, array $config)
    {
        $name = __NAMESPACE__ . '\\' . ucfirst($type) . 'Adapter';
        $key = self::getKey($type, $config);
        if (!empty(self::$_cache[$key])) {
            return self::$_cache[$key];
        }
        if (class_exists($name)) {
            $adapter = new $name($config);
            if (!$adapter instanceof Adapter) {
                throw new \Exception("Invalid Adapter Type", 500);
            }

            return self::$_cache[$key] = $adapter;
        }

        throw new \Exception("Invalid Adapter Type", 500);
    }

    private static function getKey($type, $config)
    {
        return md5($type . serialize($config));
    }

}