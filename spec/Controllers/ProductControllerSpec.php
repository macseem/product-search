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
            return json_encode($this->product);
        });

        it('Should return a valid json string', function () {
            Stub::on(Product::class)->method('::findById')->andReturn($this->product);
            expect($this->controller->detail($this->id))->toBe($this->result);
        });
    });
});