<?php
namespace Dvt\SmsTraffic\Tests;

use Dvt\SmsTraffic\Result;
use Dvt\SmsTraffic\ResultInfo;
use PHPUnit\Framework\TestCase;

class ResultTest extends TestCase
{

    const RESPONSE_SINGLE_MESSAGE = '<?xml version="1.0"?><reply><result>OK</result><code>0</code><description>queued 1 messages</description><message_infos><message_info><phone>79001234567</phone><sms_id>49497429436</sms_id></message_info></message_infos></reply>';
    const RESPONSE_ARRAY_OF_MESSAGES = '<?xml version="1.0"?><reply><result>OK</result><code>0</code><description>queued 2 messages</description><message_infos><message_info><phone>79001234567</phone><sms_id>49496865572</sms_id></message_info><message_info><phone>79001234568</phone><sms_id>49496866174</sms_id></message_info></message_infos></reply>';
    const RESPONSE_FAILED = '<?xml version="1.0" encoding="windows-1251" ?><reply><result>ERROR</result><code>432</code><description>blocked phone: 91622196. No messages has been sent</description></reply>';
    const RESPONSE_WRONG_FORMAT = '?xml version="1.0"';

    public function testDescription()
    {
        $result = new Result();
        $result->setDescription('test');
        $this->assertTrue($result->getDescription() === 'test');
    }

    public function testSetInfo()
    {
        $result = new Result();
        $this->assertTrue(is_array($result->getInfo()));
        $this->assertTrue(count($result->getInfo()) === 0);

        $resultInfo = new ResultInfo('a', 0);
        $result->setInfo([$resultInfo]);
        $this->assertTrue(count($result->getInfo()) === 1);
        $this->assertSame($resultInfo, $result->getInfo()[0]);
    }

    public function testAddInfo()
    {
        $result = new Result();
        $resultInfo1 = new ResultInfo('a', 0);
        $resultInfo2 = new ResultInfo('b', 1);
        $result->setInfo([$resultInfo1]);
        $result->addInfo($resultInfo2);
        $this->assertTrue(count($result->getInfo()) === 2);
        $this->assertSame($resultInfo2, $result->getInfo()[1]);
    }

    public function testCreateFromSingleMessage()
    {
        $result = Result::fromXml(simplexml_load_string(self::RESPONSE_SINGLE_MESSAGE));
        $this->assertTrue($result->getDescription() === 'queued 1 messages');
        $this->assertTrue(count($result->getInfo()) === 1);
        $this->assertTrue($result->getInfo()[0]->getMessageId() === '49497429436');
        $this->assertTrue($result->getInfo()[0]->getPhoneNumber() === '79001234567');
    }

    public function testCreateFromArrayOfMessages()
    {
        $result = Result::fromXml(simplexml_load_string(self::RESPONSE_ARRAY_OF_MESSAGES));
        $this->assertTrue($result->getDescription() === 'queued 2 messages');
        $this->assertTrue(count($result->getInfo()) === 2);
        $this->assertTrue($result->getInfo()[0]->getMessageId() === '49496865572');
        $this->assertTrue($result->getInfo()[0]->getPhoneNumber() === '79001234567');
        $this->assertTrue($result->getInfo()[1]->getMessageId() === '49496866174');
        $this->assertTrue($result->getInfo()[1]->getPhoneNumber() === '79001234568');
    }

}
