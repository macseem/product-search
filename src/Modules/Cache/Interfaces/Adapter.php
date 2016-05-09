<?php
namespace Macseem\Search\Modules\Cache\Interfaces;
use Macseem\Search\Modules\Cache\Exceptions\NotInCacheException;

/**
 * Interface Adapter
 * @package Macseem\Search\Modules\Cache\Interfaces
 */
interface Adapter
{
    /**
     * @param string $key
     * @return string
     * @throws NotInCacheException
     */
    public function get($key);

    /**
     * @param string $key
     * @param string $value
     * @return bool
     */
    public function set($key, $value);
    
}