<?php

namespace SKRIME\Domain;

use GuzzleHttp\Exception\GuzzleException;
use SKRIME\API;

class Nameserver
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
    public function show(string $domainName)
    {
        return $this->API->get('domain/nameserver', [
            'domain' => $domainName
        ]);
    }

    /**
     * @param string $domainName
     * @param array $nameservers
     * @return array|string
     * @throws GuzzleException
     */
    public function update(string $domainName, array $nameservers)
    {
        return $this->API->post('domain/nameserver', [
            'domain' => $domainName,
            'nameserver' => $nameservers
        ]);
    }

}