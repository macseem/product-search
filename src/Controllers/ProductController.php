<?php
namespace Macseem\Search\Controllers;
use Macseem\Search\Models\Product;
use Macseem\Search\Modules\Counter\GS;
use Macseem\Search\Modules\Framework\Di;

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
        $gs = Di::getInstance()->getShared('gs');
        $result = Product::findById($id) + [ 'requests' => $gs->get(Product::class, $id) ];
        return $this->getFormatter($this->getConfig()->formatter)->format($result);
    }
}