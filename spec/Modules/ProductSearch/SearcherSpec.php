<?php

use Kahlan\Plugin\Stub;
use Macseem\Search\Modules\ProductSearch\Interfaces\Adapter;
use Macseem\Search\Modules\ProductSearch\Searcher;

describe(Searcher::class, function () {

    describe('findByPk', function () {

        given('type', function () {
            return 'dummy';
        });

        given('config', function () {
            return [];
        });

        given('pk', function () {
            return 1;
        });

        given('data', function () {
            return [1, 2, 3];
        });

        given('adapter', function () {
            $adapter = Stub::create(['implements' => [Adapter::class]]);
            Stub::on($adapter)->method('findByPk')->andReturn($this->data);
            return $adapter;
        });

        given('searcher', function () {
            $searcher = new Searcher($this->type, $this->config);
            Stub::on($searcher)->method('getAdapter')->andReturn($this->adapter);
            return $searcher;
        });

        it('should call findByPk method in adapter', function () {
            expect($this->adapter)->toReceive('findByPk')->with($this->pk);
            expect($this->searcher->findByPk($this->pk))->toBe($this->data);
        });
    });
});
