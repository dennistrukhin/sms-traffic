<?php
namespace Dvt\SmsTraffic\Tests;

use Dvt\SmsTraffic\Authentication;
use Dvt\SmsTraffic\Config;
use Dvt\SmsTraffic\Message;
use Dvt\SmsTraffic\QueryBuilder;
use PHPUnit\Framework\TestCase;

class QueryBuilderTest extends TestCase
{

    public function testBuildQuery()
    {
        $query = (new QueryBuilder(
            new Authentication('a', 'b', 'c'),
            new Config([]),
            new Message('text'),
            ['123', '456']
        ))->buildQuery();
        $this->assertSame(
            [
                'login' => 'a',
                'password' => 'b',
                'want_sms_ids' => 1,
                'phones' => '123,456',
                'message' => 'text',
                'max_parts' => Config::DEFAULT_MAX_PARTS,
                'originator' => 'c',
                'rus' => 1,
            ],
            $query
        );
    }

}