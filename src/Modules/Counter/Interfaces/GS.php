<?php
namespace Macseem\Search\Modules\Counter\Interfaces;

/**
 * Interface Counter
 * @package Macseem\Search\Modules\Counter\Interfaces
 */
interface GS
{
    /**
     * @param string $name
     * @param int $pk
     * @return int
     */
    public function get($name, $pk);

    /**
     * @param string $name
     * @param int $pk
     * @param int $count
     * @return int
     */
    public function set($name, $pk, $count);
}