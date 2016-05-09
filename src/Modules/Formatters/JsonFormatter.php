<?php
namespace Macseem\Search\Modules\Formatters;
use Macseem\Search\Modules\Formatters\Interfaces\Format;

/**
 * Class JsonFormatter
 * @package Macseem\Search\Formatters
 */
class JsonFormatter implements Format
{

    /**
     * @param $data
     * @return string
     */
    public function format($data)
    {
        return json_encode($data);
    }
}