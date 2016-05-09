<?php
namespace Macseem\Search\Modules\ProductSearch\Drivers;
use Macseem\Search\Modules\Mysql\Driver;

/**
 * Class MySQLDriver
 * @package Macseem\Search\Modules\Search\Adapters
 * @method Driver getDriver
 */
class MysqlAdapter extends AbstractAdapter
{
    /**
     * @return mixed
     */
    protected function createDriver()
    {
        return new Driver();
    }

    /**
     * @param $pk
     * @return array
     */
    public function findByPk($pk)
    {
        return $this->getDriver()->findProduct($pk);
    }
}