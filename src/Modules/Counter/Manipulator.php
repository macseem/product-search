<?php
namespace Macseem\Search\Modules\Counter;
use Macseem\Search\Modules\Cache\Interfaces\Cache;
use Macseem\Search\Modules\Counter\Interfaces\Manipulator as ManipulatorInterface;

/**
 * Class Manipulator
 * @package Macseem\Search\Modules\Counter
 */
class Manipulator implements ManipulatorInterface
{
    private $cacher;
    private $gs;
    
    public function __construct(Cache $cacher, GS $gs)
    {
        $this->cacher = $cacher;
        $this->gs = $gs;
    }

    public function increment($name, $pk)
    {
        $count = $this->gs->get($name, $pk);
        return $this->gs->set($name, $pk, $count +1);
    }
}