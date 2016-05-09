<?php
namespace Macseem\Search\Modules\Serialize;
use Macseem\Search\Modules\Serialize\Interfaces\Serializer;

/**
 * Class Factory
 * @package Macseem\Search\Modules\Serialize
 */
class Factory
{
    /** @var Serializer[]  */
    private static $_cache = [];

    /**
     * @param $type
     * @return Serializer
     * @throws \Exception
     */
    public static function getInstance($type)
    {

        $name = __NAMESPACE__ . '\\' . ucfirst($type) . 'Serializer';
        if (!empty(self::$_cache[$name])) {
            return self::$_cache[$name];
        }
        if (class_exists($name)) {
            $serializer = new $name();
            if (!$serializer instanceof Serializer) {
                throw new \Exception("Invalid Serializer Type", 500);
            }

            return self::$_cache[$name] = $serializer;
        }

        throw new \Exception("Invalid Serializer Type", 500);
    }

}