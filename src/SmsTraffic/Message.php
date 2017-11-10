<?php
namespace Dvt\SmsTraffic;

class Message
{

    private $body;

    public function __construct(string $body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

}