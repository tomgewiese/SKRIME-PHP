<?php

namespace SKRIME\Domain;

use GuzzleHttp\Exception\GuzzleException;
use SKRIME\API;

class DomainDNS
{
    private $API;

    public function __construct(API $API)
    {
        $this->API = $API;
    }

    /**
     * @param string $domainName
     * @return array|string
     * @throws GuzzleException
     */
    public function get(string $domainName)
    {
        return $this->API->get('domain/dns', [
            'domain' => $domainName
        ]);
    }

    /**
     * @param string $domainName
     * @param array $records
     * @return array|string
     * @throws GuzzleException
     */
    public function update(string $domainName, array $records)
    {
        return $this->API->post('domain/dns', [
            'domain' => $domainName,
            'records' => $records
        ]);
    }

}