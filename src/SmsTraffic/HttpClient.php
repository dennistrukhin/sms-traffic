<?php
namespace Dvt\SmsTraffic;

use Dvt\SmsTraffic\Exception\HttpError;
use GuzzleHttp\Client;

class HttpClient
{

    const DEFAULT_TIMEOUT = 2.0;

    private $client;

    public function __construct(string $host, float $timeout = self::DEFAULT_TIMEOUT)
    {
        $this->client = new Client([
            'base_uri' => $host,
            'time_out' => $timeout,
        ]);
    }

    public function post(string $path, array $query)
    {
        try {
            $response = $this->client->post($path, [
                'form_params' => $query,
            ]);
            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpError($e->getMessage());
        }
    }

}