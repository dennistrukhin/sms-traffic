<?php

namespace Dvt\SmsTraffic;

use Dvt\SmsTraffic\Exception\HttpError;

class Service
{

    const SMS_TRAFFIC_HOST = 'http://www.smstraffic.ru';
    const SMS_TRAFFIC_HOST_FAIL_OVER = 'http://server2.smstraffic.ru';
    const SMS_TRAFFIC_PATH = '/multi.php';

    private $authentication;
    private $config;

    public function __construct(Authentication $authentication, Config $config)
    {
        $this->authentication = $authentication;
        $this->config = $config;
    }

    /**
     * @return Authentication
     */
    public function getAuthentication(): Authentication
    {
        return $this->authentication;
    }

    /**
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    public function send(Message $message, string ...$phones)
    {
        $query = (new QueryBuilder($this->authentication, $this->config, $message, $phones))->buildQuery();
        $xml = $this->sendMessages($query, new HttpResponseParser());
        if ((string)$xml->result === 'OK') {
            return Result::fromXml($xml);
        } else {
            switch ((string)$xml->code) {
                case '432':
                    $className = 'BlockedPhone';
                    break;
                default:
                    $className = 'Failed';
            }
            $className = '\\Dvt\\SmsTraffic\\Exception\\' . $className;
            /** @var \Exception $e */
            $e = new $className((string)$xml->description, (string)$xml->code);
            throw $e;
        }
    }

    /**
     * @param array $query
     * @param HttpResponseParser $httpResponseParser
     * @return \SimpleXMLElement
     */
    protected function sendMessages(array $query, HttpResponseParser $httpResponseParser): \SimpleXMLElement
    {
        try {
            $response = (new HttpClient(self::SMS_TRAFFIC_HOST))->post(self::SMS_TRAFFIC_PATH, $query);
        } catch (HttpError $e) {
            $response = (new HttpClient(self::SMS_TRAFFIC_HOST_FAIL_OVER))->post(self::SMS_TRAFFIC_PATH, $query);
        }
        return $httpResponseParser->parse($response);
    }


}