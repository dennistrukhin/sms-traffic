<?php
namespace Dvt\SmsTraffic\Tests;

use Dvt\SmsTraffic\HttpResponseParser;
use PHPUnit\Framework\TestCase;

class HttpResponseParserTest extends TestCase
{

    public function testParse()
    {
        $httpResponseParser = new HttpResponseParser();
        $this->assertTrue($httpResponseParser->parse(ResultTest::RESPONSE_ARRAY_OF_MESSAGES) instanceof \SimpleXMLElement);
    }

    /**
     * @expectedException     \Dvt\SmsTraffic\Exception\InvalidResponse
     */
    public function testParseException()
    {
        $httpResponseParser = new HttpResponseParser();
        $httpResponseParser->parse(ResultTest::RESPONSE_WRONG_FORMAT);
    }

}