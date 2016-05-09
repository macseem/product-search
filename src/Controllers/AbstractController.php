<?php
namespace Macseem\Search\Controllers;
use Macseem\Search\Modules\Formatters\Factory;
use Macseem\Search\Modules\Formatters\Interfaces\Format;

/**
 * Class AbstractController
 * @package Macseem\Search\Controllers
 */
abstract class AbstractController
{
    /**
     * @var array
     */
    private $_config;

    /**
     * AbstractController constructor.
     * @param array $config
     */
    final public function __construct(array $config)
    {
        $this->_config = (object)$config;
    }

    /**
     * @return object
     */
    public function getConfig()
    {
        return $this->_config;
    }

    /**
     * @param string $type
     * @return Format
     */
    protected function getFormatter($type = 'json') {
        return Factory::getInstance($type);
    }
}