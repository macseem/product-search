<?php
namespace Macseem\Search\Modules\Cache;

use Macseem\Search\Modules\Cache\Adapters\Factory;
use Macseem\Search\Modules\Cache\Exceptions\NotInCacheException;
use Macseem\Search\Modules\Cache\Interfaces\Cache;
use Macseem\Search\Modules\Serialize\Interfaces\Serializer;

/**
 * Class Cacher
 * @package Macseem\Search\Modules\Cache
 */
class Cacher implements Cache
{
    private $type;
    private $config;
    private $serializer;

    private function getAdapter()
    {
        return Factory::getInstance($this->type, $this->config);
    }

    public function __construct($type, array $config, Serializer $serializer)
    {
        $this->type = $type;
        $this->config = $config;
        $this->serializer = $serializer;
    }

    /**
     * @param string $key
     * @param mixed $data
     * @return bool
     */
    public function set($key, $data)
    {
        $this->getAdapter()->set($key, $this->serializer->serialize($data));
    }

    /**
     * @param $key
     * @return mixed
     * @throws NotInCacheException
     */
    public function get($key)
    {
        return $this->serializer->unserialize($this->getAdapter()->get($key));
    }
}