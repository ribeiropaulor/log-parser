<?php

    namespace Kassner\Tests\LogParser\Format;

    use Kassner\LogParser\LogParser;

    /**
     * @format %D
     * @description The request time
     */
    class RequestTimeInMicrosecondsTest extends \PHPUnit_Framework_TestCase
    {

        protected $parser = null;

        protected function setUp()
        {
            $this->parser = new LogParser();
            $this->parser->setFormat('%D');
        }

        protected function tearDown()
        {
            $this->parser = null;
        }

        /**
         * @dataProvider successProvider
         */
        public function testSuccess($line)
        {
            $entry = $this->parser->parse($line);
            $this->assertEquals($line, $entry->requestTimeMicro);
        }

        /**
         * @expectedException \Kassner\LogParser\FormatException
         * @dataProvider invalidProvider
         */
        public function testInvalid($line)
        {
            $this->parser->parse($line);
        }

        public function successProvider()
        {
            return array(
                array('32036'),
                array('323'),
                array('999'),
                array('3'),
                array('0'),
            );
        }

        public function invalidProvider()
        {
            return array(
                array('abc '),
                array(null),
                array(''),
                array(' '),
                array('-'),
                array('999.999'),
            );
        }

    }
