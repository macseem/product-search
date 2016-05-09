<?php

use Macseem\Search\Modules\Formatters\Factory;
use Macseem\Search\Modules\Formatters\JsonFormatter;

describe(JsonFormatter::class, function () {
    given('data', function () {
        return [1, 2, 3];
    });
    it('should format to json', function () {
        $formatter = Factory::getInstance('json');
        expect($formatter->format($this->data))->toBe(json_encode($this->data));
    });
});