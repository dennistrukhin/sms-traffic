<?php
namespace Dvt\SmsTraffic\Tests;

use Dvt\SmsTraffic\Authentication;
use PHPUnit\Framework\TestCase;

class AuthenticationTest extends TestCase
{

    public function testConstructor()
    {
        $authentication = new Authentication('user', 'pass', 'company');
        $this->assertTrue($authentication->getUsername() === 'user');
        $this->assertTrue($authentication->getPassword() === 'pass');
        $this->assertTrue($authentication->getCompany() === 'company');
    }

}