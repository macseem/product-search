<?php
/**
 * Created by PhpStorm.
 * User: macseem
 * Date: 5/9/16
 * Time: 11:34 AM
 */

use Kahlan\Plugin\Stub;
use Macseem\Search\Modules\Framework\BaseDi;
use Macseem\Search\Modules\Framework\Exceptions\ServiceNotFoundException;

describe(BaseDi::class, function () {

    it('exists', function () {
        expect(class_exists('Macseem\\Search\\Modules\\Framework\\BaseDi'))->toBeTruthy();
    });

    context('Methods', function () {

        describe('::getInstance()', function () {
            it('should get 2 times the same object', function () {
                $di1 = BaseDi::getInstance();
                $di2 = BaseDi::getInstance();
                expect(spl_object_hash($di1))->toBe(spl_object_hash($di2));
            });
        });

        describe('setter, getter and remove', function () {
            before(function(){
                $this->name = uniqid();
            });
            given('di', function () {
                return BaseDi::getInstance();
            });
            given('result', function () {
                return 1;
            });
            it('should set and get previously added service', function () {
                $result = $this->result;
                $this->di->set($this->name, function () use ($result) {
                    return $result;
                });
                expect($this->di->get($this->name))->toEqual(1);
            });
            it('should remove service and get and exception during get appointment', function(){
                $this->di->remove($this->name);
                expect(function(){$this->di->get($this->name);})->toThrow(new ServiceNotFoundException("", 500));
            });
        });
    });
});