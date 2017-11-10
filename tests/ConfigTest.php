<?php
namespace Dvt\SmsTraffic\Tests;

use Dvt\SmsTraffic\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{

    public function testConstructorWithFullArray()
    {
        $config = new Config([
            'transliterate' => true,
            'maxParts' => 20,
        ]);
        $this->assertTrue($config->isTransliterate() === true);
        $this->assertTrue($config->getMaxParts() === 20);
    }

}