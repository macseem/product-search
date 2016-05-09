<?php
namespace Macseem\Search\Modules\ElasticSearch\Interfaces;

/**
 * Interface IElasticSearchDriver
 * @package Macseem\Search\Modules\ElasticSearch\Interfaces
 */
interface IElasticSearchDriver
{
    /**
     * @param string $id
     * @return array
     */
    public function findById($id);
}