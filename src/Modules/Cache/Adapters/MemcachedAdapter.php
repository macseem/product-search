<?php
namespace Macseem\Search\Modules\Cache\Adapters;
use Macseem\Search\Modules\Cache\Exceptions\NotInCacheException;
use Macseem\Search\Modules\Cache\Interfaces\Adapter;

/**
 * Class MemcacheAdapter
 * @package Macseem\Search\Modules\Cache\Adapters
 * @method \Memcache getConnection 
 */
class MemcachedAdapter extends AbstractAdapter implements Adapter
{

    /**
     * @param string $key
     * @return string
     * @throws NotInCacheException
     */
    public function get($key)
    {
        $result = $this->getConnection()->get($key);
        if($result === false) {
            throw new NotInCacheException("Not in cache", 500);
        }
        return $result;
    }

    /**
     * @param string $key
     * @param string $value
     * @return bool
     */
    public function set($key, $value)
    {
        $this->getConnection()->set($key, $value);
    }

    /**
     * @param array $config
     * @return \Memcache
     */
    protected function connect(array $config)
    {
        $client = new \Memcached();
        $client->addServer($config['host'], $config['port']);
        return $client;
    }
}