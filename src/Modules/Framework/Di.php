<?php
namespace Macseem\Search\Modules\Framework;

/**
 * Class Di
 * @package Macseem\Search\Modules\Framework
 * @method static Di getInstance
 */
class Di extends BaseDi
{
    private static $sharedServices = [];
    private static $cachedServices = [];

    public function getShared($name)
    {
        if(empty(self::$cachedServices[$name])) {
            self::$cachedServices[$name] = parent::get($name);
        }
        return self::$cachedServices[$name];
    }
    
    public function get($name)
    {
        if(in_array($name, self::$sharedServices)){
            return $this->getShared($name);
        }
        return parent::get($name);
    }

    public function setShared($name, $service)
    {
        self::$sharedServices[] = $name;
        return self::set($name, $service);
    }

    public function remove($name)
    {
        unset(self::$sharedServices[array_search($name, self::$sharedServices[])]);
    }
}