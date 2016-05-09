<?php
namespace Macseem\Search\Modules\ElasticSearch;
use Macseem\Search\Modules\ElasticSearch\Interfaces\IElasticSearchDriver;

/**
 * Class Driver
 * @package Macseem\Search\Modules\ElasticSearch
 */
class Driver implements IElasticSearchDriver
{

    /**
     * @param string $id
     * @return array
     */
    public function findById($id)
    {
        return ['id' => $id, 'name' => 'name'];
    }
}