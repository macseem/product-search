<?php
namespace Macseem\Search\Controllers;
use Macseem\Search\Models\Product;

/**
 * Class ProductController
 */
class ProductController extends AbstractController
{
    /**
     * @param string $id
     * @return string
     */
    public function detail($id)
    {
        return $this->getFormatter($this->getConfig()->formatter)->format(Product::findById($id));
    }
}