<?php
/**
 * Created by PhpStorm.
 * User: macseem
 * Date: 5/9/16
 * Time: 12:36 AM
 */

namespace Macseem\Search\Modules\Serialize\Interfaces;


interface Serializer
{
    /**
     * @param mixed $data
     * @return string
     */
    public function serialize($data);

    /**
     * @param string $data
     * @return mixed
     */
    public function unserialize($data);
}