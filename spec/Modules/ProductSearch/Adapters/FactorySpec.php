<?php
namespace Macseem\Search\Modules\ProductSearch\Adapters {

    class DummyAdapter extends AbstractAdapter{
        /**
         * @return mixed
         */
        protected function createDriver()
        {
            return new \stdClass();
        }

        /**
         * @param $pk
         * @return array
         */
        public function findByPk($pk)
        {
            // TODO: Implement findByPk() method.
        }
    }
}
namespace {

    use Macseem\Search\Modules\ProductSearch\Adapters\DummyAdapter;
    use Macseem\Search\Modules\ProductSearch\Adapters\Factory;

    describe(Factory::class, function(){
        it('should return dummy ProductSearch adapter', function(){
            expect(Factory::getInstance('dummy', []))->toBeAnInstanceOf(DummyAdapter::class);
        });
    });
}