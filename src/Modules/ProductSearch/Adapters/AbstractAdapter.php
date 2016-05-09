<?php
namespace Macseem\Search\Modules\ProductSearch\Adapters;
use Macseem\Search\Modules\ProductSearch\Interfaces\Adapter;

/**
 * Class AbstractAdapter
 * @package Macseem\Search\Modules\Search\Drivers
 */
abstract class AbstractAdapter implements Adapter
{
    /** @var array  */
    private $_config = [];
    private $_driver;
    /**
     * AbstractDriver constructor.
     * @param array $config
     */
    final public function __construct( array $config )
    {
        $this->_config = $config;
    }

    /**
     * @return array
     */
    public function getConfig() {
        return $this->_config;
    }

    /**
     * @return mixed
     */
    protected function getDriver(){
        if(empty($this->_driver)){
            $this->_driver = $this->createDriver();
        }
        return $this->_driver;
    }

    /**
     * @return mixed
     */
    abstract protected function createDriver();
}