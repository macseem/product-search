<?php
namespace Macseem\Search\Modules\ProductSearch\Interfaces;

/**
 * Interface ISearch
 * @package Macseem\Search\Modules\Search
 */
interface IFindByPk
{
    /**
     * @param $pk
     * @return array
     */
    public function findByPk($pk);
}