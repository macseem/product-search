<?php
namespace Macseem\Search\Modules\Serialize {

    use Macseem\Search\Modules\Serialize\Interfaces\Serializer;

    class DummySerializer implements Serializer
    {

        /**
         * @param mixed $data
         * @return string
         */
        public function serialize($data)
        {
            return $data;
        }

        /**
         * @param string $data
         * @return mixed
         */
        public function unserialize($data)
        {
            return $data;
        }
    }
}

namespace {

    use Macseem\Search\Modules\Serialize\DummySerializer;
    use Macseem\Search\Modules\Serialize\Factory;

    describe(Factory::class, function () {
        it('Should return DummySerializer', function () {
            expect(Factory::getInstance('dummy'))->toBeAnInstanceOf(DummySerializer::class);
        });
    });

}