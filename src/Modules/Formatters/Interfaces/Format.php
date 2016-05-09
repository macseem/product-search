<?php
namespace Macseem\Search\Modules\Formatters\Interfaces;


interface Format
{
    /**
     * @param $data
     * @return string
     */
    public function format($data);
}