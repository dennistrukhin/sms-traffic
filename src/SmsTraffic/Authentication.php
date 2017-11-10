<?php
namespace Dvt\SmsTraffic;

class Authentication
{

    private $username = '';
    private $password = '';
    private $company = '';

    public function __construct(string $username, string $password, string $company)
    {
        $this->username = $username;
        $this->password = $password;
        $this->company = $company;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getCompany(): string
    {
        return $this->company;
    }

}