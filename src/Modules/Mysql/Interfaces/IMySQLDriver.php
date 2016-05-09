<?php
namespace Macseem\Search\Modules\Mysql\Interfaces;

/**
 * Interface IMySQLDriver
 * @package Macseem\Search\Modules\Mysql\Interfaces
 */
interface IMySQLDriver
{
    /**
     * @param string $id
     * @return array
     */
    public function findProduct($id);
}