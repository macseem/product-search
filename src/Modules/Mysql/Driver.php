<?php
namespace Macseem\Search\Modules\Mysql;
use Macseem\Search\Modules\Mysql\Interfaces\IMySQLDriver;

/**
 * Class Driver
 * @package Macseem\Search\Modules\Mysql
 */
class Driver implements IMySQLDriver
{

    /**
     * @param string $id
     * @return array
     */
    public function findProduct($id)
    {
        return ['id' => $id, 'name' => 'name'];
    }
}