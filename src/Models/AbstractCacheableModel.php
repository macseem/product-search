<?php
namespace Macseem\Search\Models;

use League\Event\Event;
use Macseem\Search\Modules\Cache\Cacher;
use Macseem\Search\Modules\Cache\Exceptions\NotInCacheException;
use Macseem\Search\Modules\Counter\GS;
use Macseem\Search\Modules\Counter\Manipulator;
use Macseem\Search\Modules\Framework\Di;
use Macseem\Search\Modules\Framework\Exceptions\ServiceNotFoundException;

/**
 * Class AbstractCacheableModel
 * @package Macseem\Search\Models
 * @method static findByPk($value)
 */
abstract class AbstractCacheableModel extends AbstractModel
{

    /**
     * @return Cacher
     * @throws ServiceNotFoundException
     */
    private static function getCacher()
    {
        return Di::getInstance()->get('cacher');
    }

    static private function generateKey($key, $value)
    {
        return static::class . $key . '=' . (string)$value;
    }

    /**
     * @param $value
     * @return mixed
     * @throws NotInCacheException
     */
    static private function findInCacheByPk($value)
    {
        return self::getCacher()->get(self::generateKey(static::getPk(), $value));
    }

    static protected function cache($model)
    {
        return self::getCacher()->set(self::generateKey(static::getPk(), $model[static::getPk()]), $model);
    }

    static protected function _findByPk($value)
    {
        try {
            return self::findInCacheByPk($value);
        } catch (NotInCacheException $e) {
            $model = parent::_findByPk($value);
            self::cache($model);
            return $model;
        }
    }


    protected static function oneTimeListeners()
    {
        $cacher = self::getCacher();
        return [
            [
                'event' => static::class . '.findByPk',
                'listener' => function (Event $event, $param) use ($cacher) {
                    $id = $param[0];
                    $gs = new GS($cacher);
                    $manipulator = new Manipulator($cacher, $gs);
                    $manipulator->increment(static::class, $id);
                }
            ]
        ];
    }


}