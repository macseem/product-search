<?php
namespace Macseem\Search\Modules\Cache\Interfaces;
use Macseem\Search\Modules\Cache\Exceptions\NotInCacheException;

/**
 * Interface Cache
 * @package Macseem\Search\Modules\Cache\Interfaces
 */
interface Cache
{
    /**
     * @param $key
     * @return mixed
     * @throws NotInCacheException
     */
    public function get($key);

    /**
     * @param string $key
     * @param mixed $data
     * @return bool
     */
    public function set($key, $data);
}