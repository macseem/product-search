<?php
namespace Macseem\Search\Models;

use Macseem\Search\Models\Interfaces\getPk;
use Macseem\Search\Modules\Framework\Di;
use Macseem\Search\Modules\Framework\EventBasedClass;
use Macseem\Search\Modules\Framework\Exceptions\ServiceNotFoundException;
use Macseem\Search\Modules\ProductSearch\Searcher;

/**
 * Class AbstractModel
 * @package Macseem\Search\Models
 * @method static array findByPk($value)
 */
abstract class AbstractModel extends EventBasedClass implements getPk
{

    /**
     * @return Searcher
     * @throws ServiceNotFoundException
     */
    protected static function getSearcher()
    {
        return Di::getInstance()->get('searcher');
    }

    /**
     * @param $value
     * @return array
     */
    protected static function _findByPk($value)
    {
        return self::getSearcher()->findByPk($value);
    }
}