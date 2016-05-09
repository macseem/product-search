<?php
namespace Macseem\Search\Models;
use Macseem\Search\Models\Interfaces\getPk;
use Macseem\Search\Modules\Framework\Di;
use Macseem\Search\Modules\Framework\Exceptions\ServiceNotFoundException;
use Macseem\Search\Modules\Search\Searcher;

/**
 * Class AbstractModel
 * @package Macseem\Search\Models
 */
abstract class AbstractModel implements getPk
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
    static protected function findByPk($value)
    {
        return self::getSearcher()->findByPk($value);
    }


}