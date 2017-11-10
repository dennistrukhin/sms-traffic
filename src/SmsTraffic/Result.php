<?php

namespace Dvt\SmsTraffic;

class Result
{

    private $description = '';
    /** @var ResultInfo[] $info */
    private $info = [];

    public static function fromXml(\SimpleXMLElement $xml)
    {
        $result = new self();
        $result->setDescription((string)$xml->description);
        foreach ($xml->message_infos->children() as $messageInfo) {
            $result->addInfo(new ResultInfo((string)$messageInfo->phone, (string)$messageInfo->sms_id));
        }
        return $result;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return ResultInfo[]
     */
    public function getInfo(): array
    {
        return $this->info;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @param ResultInfo[] $info
     */
    public function setInfo(array $info)
    {
        $this->info = $info;
    }

    /**
     * @param ResultInfo $info
     */
    public function addInfo(ResultInfo $info)
    {
        $this->info[] = $info;
    }

}