<?php
namespace Macseem\Search\Modules\Framework;
use Macseem\Search\Modules\Framework\Exceptions\ServiceNotFoundException;
use Macseem\Search\Modules\Framework\Interfaces\Di as DiInterface;

/**
 * Class Di
 * @package Macseem\Search\Modules\Framework
 */
class Di implements DiInterface
{
    /**
     * @var
     */
    private static $instance;

    /**
     * @var array
     */
    private static $services = [];

    /**
     * Di constructor.
     */
    private function __construct()
    {
        
    }

    /**
     * @return Di
     */
    public static function getInstance()
    {
        if(empty(self::$instance)){
            self::$instance = new self;
        }
        return self::$instance;
    }


    /**
     * @param string $name
     * @return mixed
     * @throws ServiceNotFoundException
     */
    public function get($name)
    {
        if(isset(self::$services[$name])){
            $callable = self::$services[$name];
            return $callable();
        }
        throw new ServiceNotFoundException("Srvice $name not found in Di", 500);
    }

    /**
     * @param string $name
     * @param callable $service
     * @return mixed
     */
    public function set($name, $service)
    {
        return self::$services[$name] = $service;
    }

    /**
     * @param $name
     */
    public function remove($name)
    {
        unset(self::$services[$name]);
    }
}