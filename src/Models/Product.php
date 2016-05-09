<?php
namespace Macseem\Search\Models;

/**
 * Class Product
 * @package Macseem\Search\Models
 */
class Product extends AbstractCacheableModel
{

    /**
     * @param $id
     * @return array
     */
    static public function findById($id)
    {
        return parent::findByPk($id);
    }

    public static function getPk()
    {
        return 'id';
    }
}