<?php

use Macseem\Search\Modules\Serialize\StandardSerializer;

describe(StandardSerializer::class, function () {
    given('serializer', function () {
        return new StandardSerializer();
    });

    given('data', function () {
        return [1, 2, 3];
    });

    it('serializes data', function () {
        expect($this->serializer->serialize($this->data))->toBe(serialize($this->data));
    });
});