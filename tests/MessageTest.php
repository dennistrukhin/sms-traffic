<?php
namespace Dvt\SmsTraffic\Tests;

use Dvt\SmsTraffic\Message;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{

    public function testConstructor()
    {
        $message = new Message('text');
        $this->assertTrue($message->getBody() === 'text');
    }

}