<?php
namespace Macseem\Search\Modules\ProductSearch\Interfaces;


interface Adapter
{
    /**
     * @param $pk
     * @return array
     */
    public function findByPk($pk);
}