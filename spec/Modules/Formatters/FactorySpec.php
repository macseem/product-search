<?php
namespace Macseem\Search\Modules\Formatters{
    use Macseem\Search\Modules\Formatters\Interfaces\Format;

    class DummyFormatter implements Format {
        /**
         * @param $data
         * @return string
         */
        public function format($data)
        {
            return $data;
        }
    }
}

namespace {

    use Macseem\Search\Modules\Formatters\DummyFormatter;
    use Macseem\Search\Modules\Formatters\Factory;

    describe(Factory::class, function(){
        it('should return dummy formatter', function(){
            $formatter = Factory::getInstance('dummy');
            expect($formatter)->toBeAnInstanceOf(DummyFormatter::class);
        });
    });
}

