<?php
namespace Dvt\SmsTraffic;

class Config
{

    const DEFAULT_MAX_PARTS = 10;

    private $transliterate = false;
    private $maxParts = self::DEFAULT_MAX_PARTS;

    public function __construct(array $config)
    {
        $this->transliterate = $config['transliterate'] ?? false;
        $this->maxParts = $config['maxParts'] ?? self::DEFAULT_MAX_PARTS;
    }

    public function isTransliterate(): bool
    {
        return $this->transliterate;
    }

    /**
     * @return int
     */
    public function getMaxParts(): int
    {
        return $this->maxParts;
    }

}