<?php
namespace Macseem\Search\Modules\Serialize;
use Macseem\Search\Modules\Serialize\Interfaces\Serializer;

/**
 * Class StandardSerializer
 * @package Macseem\Search\Modules\Serialize
 */
class StandardSerializer implements Serializer
{

    /**
     * @param mixed $data
     * @return string
     */
    public function serialize($data)
    {
        return serialize($data);
    }

    /**
     * @param string $data
     * @return mixed
     */
    public function unserialize($data)
    {
        return unserialize($data);
    }
}