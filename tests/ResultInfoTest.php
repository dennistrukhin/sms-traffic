<?php
namespace Dvt\SmsTraffic\Tests;

use Dvt\SmsTraffic\ResultInfo;
use PHPUnit\Framework\TestCase;

class ResultInfoTest extends TestCase
{

    public function testConstructor()
    {
        $resultInfo = new ResultInfo('123', '456');
        $this->assertTrue($resultInfo->getPhoneNumber() === '123');
        $this->assertTrue($resultInfo->getMessageId() === '456');
    }

}