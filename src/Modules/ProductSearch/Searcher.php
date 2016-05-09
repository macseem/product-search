<?php
namespace Macseem\Search\Modules\ProductSearch;
use Macseem\Search\Modules\ProductSearch\Adapters\Factory;
use Macseem\Search\Modules\ProductSearch\Interfaces\IFindByPk;

/**
 * Class Searcher
 * @package Macseem\Search\Modules\Search
 */
class Searcher implements IFindByPk
{
    private $type;
    private $config;

    public function __construct($type, $config)
    {
        $this->type = $type;
        $this->config = $config;
    }
    
    
    /**
     * @param $pk
     * @return array
     */
    public function findByPk($pk)
    {
        return $this->getAdapter()->findByPk($pk);
    }

    /**
     * @return Interfaces\Adapter
     * @throws \Exception
     */
    protected function getAdapter()
    {
        return Factory::getInstance($this->type, $this->config);
    }
}