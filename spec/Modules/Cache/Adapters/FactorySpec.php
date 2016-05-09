<?php
namespace Macseem\Search\Modules\Cache\Adapters {

    use Macseem\Search\Modules\Cache\Exceptions\NotInCacheException;
    use Macseem\Search\Modules\Cache\Interfaces\Adapter;

    class DummyAdapter implements Adapter{
        /**
         * @param string $key
         * @return string
         * @throws NotInCacheException
         */
        public function get($key)
        {
            // TODO: Implement get() method.
        }

        /**
         * @param string $key
         * @param string $value
         * @return bool
         */
        public function set($key, $value)
        {
            // TODO: Implement set() method.
        }
    }
}
namespace {

    use Macseem\Search\Modules\Cache\Adapters\Factory;
    use Macseem\Search\Modules\Cache\Interfaces\Adapter;

    describe(Factory::class, function(){
        it('should return DummyAdapter', function(){
            expect(Factory::getInstance('dummy', []))->toBeAnInstanceOf(Adapter::class);
        });
    });
}