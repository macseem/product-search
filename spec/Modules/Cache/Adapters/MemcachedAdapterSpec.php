<?php
/**
 * Created by PhpStorm.
 * User: macseem
 * Date: 5/9/16
 * Time: 4:21 PM
 */
use Macseem\Search\Modules\Cache\Adapters\MemcachedAdapter;
use Macseem\Search\Modules\Cache\Exceptions\NotInCacheException;

describe(MemcachedAdapter::class, function () {

    it('exists', function () {
        expect(class_exists('Macseem\\Search\\Modules\\Cache\\Adapters\\MemcachedAdapter'))->toBeTruthy();
    });
    given('host', function () {
        return 'memcached';
    });
    given('port', function () {
        return '11211';
    });
    given('config', function () {
        return [
            'host' => $this->host,
            'port' => $this->port
        ];
    });
    describe('Connecting', function () {

        it('should connect to memcache server', function () {
            $adapter = new MemcachedAdapter($this->config);
            expect($adapter)->toBeAnInstanceOf(MemcachedAdapter::class);
            $reflection = new ReflectionMethod(MemcachedAdapter::class, 'getConnection');
            $reflection->setAccessible(true);
            expect($reflection->invoke($adapter))->toBeAnInstanceOf(Memcached::class);
        });
    });

    describe('get and set', function () {
        given('adapter', function () {
            return new MemcachedAdapter($this->config);
        });
        given('key', function () {
            return uniqid();
        });
        given('data', function () {
            return 'data';
        });

        it('should throw an Exception on empty data', function () {
            expect(function () {
                $this->adapter->get($this->key);
            })->toThrow(new NotInCacheException("", 500));
        });

        it('should set data and get it then', function () {
            $this->adapter->set($this->key, $this->data);
            expect($this->adapter->get($this->key))->toBe($this->data);
        });
    });
});