<?php
/**
 * Created by PhpStorm.
 * User: macseem
 * Date: 5/9/16
 * Time: 11:22 AM
 */

namespace Macseem\Search\Modules\Framework\Interfaces;


interface Di
{
    public function get($name);
    
    public function set($name, $service);
    
    public function remove($name);
}