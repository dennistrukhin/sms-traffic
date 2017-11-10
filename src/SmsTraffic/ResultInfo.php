<?php
namespace Dvt\SmsTraffic;

class ResultInfo
{

    private $phoneNumber = '';
    private $messageId = '';

    public function __construct(string $phoneNumber, string $messageId)
    {
        $this->phoneNumber = $phoneNumber;
        $this->messageId = $messageId;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @return string
     */
    public function getMessageId(): string
    {
        return $this->messageId;
    }

}