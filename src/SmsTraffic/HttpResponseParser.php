<?php
namespace Dvt\SmsTraffic;

use Dvt\SmsTraffic\Exception\InvalidResponse;

class HttpResponseParser
{

    /**
     * @param string $response
     * @return \SimpleXMLElement
     * @throws InvalidResponse
     */
    public function parse(string $response)
    {
        $xml = simplexml_load_string($response, \SimpleXMLElement::class, LIBXML_NOERROR);
        if ($xml === false) {
            throw new InvalidResponse('SmsTraffic service sent an invalid response: ' . $response);
        }
        return $xml;
    }

}