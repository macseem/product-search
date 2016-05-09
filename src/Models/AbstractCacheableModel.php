<?php
namespace Macseem\Search\Models;

use Macseem\Search\Modules\Cache\Cacher;
use Macseem\Search\Modules\Cache\Exceptions\NotInCacheException;
use Macseem\Search\Modules\Framework\Di;
use Macseem\Search\Modules\Framework\Exceptions\ServiceNotFoundException;

/**
 * Class AbstractCacheableModel
 * @package Macseem\Search\Models
 */
abstract class AbstractCacheableModel extends AbstractModel
{

    /**
     * @return Cacher
     * @throws ServiceNotFoundException
     */
    static private function getCacher()
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

    static protected function findByPk($value)
    {
        try {
            return self::findInCacheByPk($value);
        } catch (NotInCacheException $e) {
            $model = parent::findByPk($value);
            self::cache($model);
            return $model;
        }
    }


}