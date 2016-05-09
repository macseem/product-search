<?php

use Kahlan\Plugin\Stub;
use Macseem\Search\Models\Product;
use Macseem\Search\Modules\Cache\Cacher;
use Macseem\Search\Modules\Cache\Exceptions\NotInCacheException;
use Macseem\Search\Modules\Framework\BaseDi;
use Macseem\Search\Modules\ProductSearch\Searcher;

describe(Product::class, function () {

    describe('::findById(id)', function () {
        before(function () {
            $this->cacher = Stub::create(['extends' => Cacher::class, 'methods' => ['__construct']]);
            $cacher = $this->cacher;
            BaseDi::getInstance()->set('cacher', function () use ($cacher) {
                return $cacher;
            });
            $this->searcher = Stub::create(['extends' => Searcher::class, 'methods' => ['__construct']]);
            $searcher = $this->searcher;
            BaseDi::getInstance()->set('searcher', function () use ($searcher) {
                return $searcher;
            });
        });
        after(function () {
            BaseDi::getInstance()->remove('cacher');
        });

        given('id', function () {
            return 1;
        });

        given('name', function () {
            return 'name';
        });

        given('data', function () {
            return ['id' => $this->id, 'name' => $this->name];
        });

        given('cacheKey', function () {
            return Product::class . 'id=' . $this->id;
        });

        context('cached', function () {

            beforeEach(function () {
                Stub::on($this->cacher)->method('get')->andReturn($this->data);
            });

            it('gets cached model and returns it', function () {
                expect(Product::findById($this->id))->toBe($this->data);
            });
        });

        context('not cached', function () {

            beforeEach(function () {
                Stub::on($this->cacher)->method('get', function () {
                    throw new NotInCacheException;
                });
                Stub::on($this->cacher)->method('set')->with($this->cacheKey, $this->data)->andReturn(true);
                Stub::on($this->searcher)->method('findByPk')->andReturn($this->data);
            });

            it('gets model from search module cache it and returns it', function () {
                expect($this->cacher)->toReceive('set')->with($this->cacheKey, $this->data);
                expect(Product::findById($this->id))->toBe($this->data);
            });
        });
    });
});