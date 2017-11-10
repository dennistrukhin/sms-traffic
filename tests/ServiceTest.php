<?php
namespace Dvt\SmsTraffic\Tests;

use Dvt\SmsTraffic\Authentication;
use Dvt\SmsTraffic\Config;
use Dvt\SmsTraffic\Service;
use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{

    public function testConstructor()
    {
        $auth = new Authentication('a', 'b', 'c');
        $config = new Config([]);
        $service = new Service($auth, $config);
        $this->assertSame($auth, $service->getAuthentication());
        $this->assertSame($config, $service->getConfig());
    }

}