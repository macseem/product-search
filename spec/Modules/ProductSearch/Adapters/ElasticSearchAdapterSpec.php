<?php

use Macseem\Search\Modules\ElasticSearch\Driver;
use Macseem\Search\Modules\ProductSearch\Adapters\ElasticSearchAdapter;

describe(ElasticSearchAdapter::class, function () {

    given('config', function () {
        return [];
    });

    given('adapter', function () {
        return new ElasticSearchAdapter($this->config);
    });

    given('pk', function () {
        return 1;
    });

    given('data', function(){
        return (new Driver())->findById($this->pk);
    });

    it('should call driver a findById method', function () {
        expect($this->adapter->findByPk($this->pk))->toBe($this->data);
    });
});