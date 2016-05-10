<?php
namespace Macseem\Search\Modules\Counter;
use Macseem\Search\Modules\Cache\Exceptions\NotInCacheException;
use Macseem\Search\Modules\Cache\Interfaces\Cache;
use Macseem\Search\Modules\Counter\Interfaces\GS as GSInterface;

/**
 * Class GS
 * @package Macseem\Search\Modules\Counter
 */
class GS implements GSInterface
{
    private $cacher;
    
    private function generateCacheKey($name, $pk)
    {
        return "counter.$name.$pk";
    }
    
    public function __construct(Cache $cacher)
    {
        $this->cacher = $cacher;
    }

    /**
     * @param string $name
     * @param int $pk
     * @return int
     */
    public function get($name, $pk)
    {
        try{
            return $this->cacher->get($this->generateCacheKey($name, $pk));
        } catch (NotInCacheException $e) {
            return 0;
        }
    }

    /**
     * @param string $name
     * @param int $pk
     * @param int $count
     * @return int
     */
    public function set($name, $pk, $count)
    {
        return $this->cacher->set($this->generateCacheKey($name, $pk), $count);
    }
}