<?php
/**
 * Created by PhpStorm.
 * User: macseem
 * Date: 5/10/16
 * Time: 2:52 AM
 */

namespace Macseem\Search\Modules\Counter\Interfaces;


interface Manipulator
{
    public function increment($name, $pk);
}