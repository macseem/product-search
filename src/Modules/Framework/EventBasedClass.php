<?php
namespace Macseem\Search\Modules\Framework;

use League\Event\Emitter;

/**
 * Class EventBasedClass
 * @package Macseem\Search\Modules\Framework
 */
class EventBasedClass
{

    /**
     * @return Emitter
     */
    protected static function getEmitter()
    {
        return Di::getInstance()->get('emitter');
    }

    private static function generateEventName($name)
    {
        return static::class . '.'. $name;
    }

    /**
     * @param $name
     * @param $arguments
     */
    public static function __callStatic($name, $arguments)
    {
        static::addOneTimeListeners();
        $result = call_user_func_array([static::class, '_' . $name], $arguments);
        self::getEmitter()->emit(static::generateEventName($name), $arguments);
        return $result;
    }

    private static function addOneTimeListeners()
    {
        foreach(static::oneTimeListeners() as $listener) {
            self::getEmitter()->addOneTimeListener($listener['event'], $listener['listener']);
        }
    }

    /**
     * Example:
     * [
     *   [
     *     'event' => '*.findByPk',
     *     'listener' => function($event, $param){}
     *   ]
     * ]
     * @return array
     */
    protected static function oneTimeListeners()
    {
        return [];
    }
}