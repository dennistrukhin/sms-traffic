<?php
namespace Dvt\SmsTraffic;

class QueryBuilder
{

    /** @var Authentication $authentication */
    private $authentication;
    /** @var Config $config */
    private $config;
    /** @var Message $message */
    private $message;
    private $phones;

    public function __construct(Authentication $authentication, Config $config, Message $message, array $phones)
    {
        $this->authentication = $authentication;
        $this->config = $config;
        $this->message = $message;
        $this->phones = $phones;
    }

    public function buildQuery()
    {
        $query = [
            'login' => $this->authentication->getUsername(),
            'password' => $this->authentication->getPassword(),
            'want_sms_ids' => 1,
            'phones' => implode(',', $this->phones),
            'message' => iconv(mb_detect_encoding($this->message->getBody()), 'cp1251', $this->message->getBody()),
            'max_parts' => $this->config->getMaxParts(),
            'originator' => $this->authentication->getCompany(),
            'rus' => $this->config->isTransliterate() ? 0 : 1,
        ];
        return $query;
    }

}