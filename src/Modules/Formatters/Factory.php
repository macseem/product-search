<?php
namespace Macseem\Search\Modules\Formatters;

use Macseem\Search\Modules\Formatters\Interfaces\Format;

/**
 * Class Factory
 * @package Macseem\Search\Formatters
 */
class Factory
{
    /** @var Format[] */
    private static $_cache = [];

    /**
     * @param $type
     * @return Format
     * @throws \Exception
     */
    public static function getInstance($type)
    {
        $name = __NAMESPACE__ . '\\' . ucfirst($type) . 'Formatter';
        if (!empty(self::$_cache[$name])) {
            return self::$_cache[$name];
        }
        if (class_exists($name)) {
            $formatter = new $name();
            if (!$formatter instanceof Format) {
                throw new \Exception("Invalid Formatter Type", 500);
            }

            return self::$_cache[$name] = $formatter;
        }

        throw new \Exception("Invalid Formatter Type", 500);
    }

}