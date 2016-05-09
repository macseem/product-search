<?php
namespace Macseem\Search\Modules\Cache\Adapters;
use Macseem\Search\Modules\Cache\Interfaces\Adapter;

/**
 * Class AbstractAdapter
 * @package Macseem\Search\Modules\Cache\Adapters
 */
abstract class AbstractAdapter implements Adapter
{
    private $connection;
    
    public function __construct(array $config)
    {
        $this->connection = $this->connect($config);
    }

    /**
     * @param array $config
     * @return mixed
     */
    abstract protected function connect(array $config);

    /**
     * @return mixed
     */
    protected function getConnection()
    {
        return $this->connection;
    }
    
}