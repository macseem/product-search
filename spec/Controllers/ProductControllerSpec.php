<?php
/**
 * Created by PhpStorm.
 * User: macseem
 * Date: 5/8/16
 * Time: 10:34 PM
 */

use Kahlan\Plugin\Stub;
use Macseem\Search\Controllers\ProductController;
use Macseem\Search\Models\Product;
use Macseem\Search\Modules\Cache\Cacher;
use Macseem\Search\Modules\Counter\GS;
use Macseem\Search\Modules\Framework\Di;

describe(ProductController::class, function () {

    it('exists', function () {
        expect(class_exists('Macseem\\Search\\Controllers\\ProductController'))->toBeTruthy();
    });

    describe('->detail(id)', function () {

        given('config', function () {
            return [
                'formatter' => 'json'
            ];
        });
        given('id', function () {
            return 1;
        });

        given('name', function () {
            return 'name';
        });

        given('controller', function () {
            return new ProductController($this->config);
        });

        given('product', function () {
            return ['id' => $this->id, 'name' => $this->name];
        });

        given('result', function () {
            return json_encode($this->product + ['requests' => 1]);
        });


        it('Should return a valid json string', function () {
            $di = Di::getInstance();
            $di->setShared('gs', function () {
                $gs = Stub::create(['extends' => GS::class, 'methods' => ['__construct']]);
                Stub::on($gs)->method('get')->andReturn(1);
                return $gs;
            });
            Stub::on(Product::class)->method('::findById')->with($this->id)->andReturn($this->product);
            $result = $this->controller->detail($this->id);
            expect($result)->toBe($this->result);
            $di->remove('cacher');
        });
    });
});