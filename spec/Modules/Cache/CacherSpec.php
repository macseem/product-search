<?php
/**
 * Created by PhpStorm.
 * User: macseem
 * Date: 5/9/16
 * Time: 1:03 AM
 */

use Kahlan\Plugin\Stub;
use Macseem\Search\Modules\Cache\Adapters\AbstractAdapter;
use Macseem\Search\Modules\Cache\Cacher;
use Macseem\Search\Modules\Cache\Interfaces\Adapter;
use Macseem\Search\Modules\Serialize\Factory as SerializeFactory;

describe(Cacher::class, function () {

    context('Methods', function () {

        given('type', function () {
            return 'memcached';
        });

        given('config', function () {
            return [];
        });

        given('serializer', function () {
            return SerializeFactory::getInstance('standard');
        });

        describe('__construct', function () {
            it('creates Cacher object', function () {
                expect(new Cacher($this->type, $this->config, $this->serializer))->toBeAnInstanceOf(Cacher::class);
            });
        });

        describe('getter and setter', function () {
            given('data', function () {
                return [1, 2, 3];
            });
            given('key', function () {
                return 'key';
            });
            beforeEach(function () {
                $this->adapter = Stub::create([
                    'extends' => AbstractAdapter::class,
                    'implements' => [Adapter::class],
                    'methods' => ['__construct']
                ]);
                Stub::on($this->adapter)->method('get')->andReturn($this->serializer->serialize($this->data));
                Stub::on($this->adapter)->method('set')->andReturn($this->serializer->serialize($this->data));

                $this->cacher = Stub::create(
                    [
                        'extends' => Cacher::class,
                        'params' => [$this->type, $this->config, $this->serializer]
                    ]
                );
            });

            it('sets data', function () {
                Stub::on($this->cacher)->method('getAdapter')->andReturn($this->adapter);
                expect($this->adapter)->toReceive('set')->with($this->key, $this->serializer->serialize($this->data));
                $this->cacher->set($this->key, $this->data);
                expect($this->adapter)->toReceive('get')->with($this->key);
                expect($this->cacher->get($this->key))->toBe($this->data);
            });
        });
    });
});