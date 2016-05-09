<?php
namespace Macseem\Search\Modules\ProductSearch\Adapters;
use Macseem\Search\Modules\ElasticSearch\Driver;

/**
 * Class ElasticSearchAdapter
 * @package Macseem\Search\Modules\Search\Drivers
 * @method Driver getDriver
 */
class ElasticSearchAdapter extends AbstractAdapter
{
    /**
     * @return Driver
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
        return $this->getDriver()->findById($pk);
    }
}