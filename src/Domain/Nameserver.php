<?php

namespace Skrime\Domain;

use GuzzleHttp\Exception\GuzzleException;
use Skrime\SkrimeAPI;

class Nameserver
{
    private $SkrimeAPI;

    public function __construct(SkrimeAPI $SkrimeAPI)
    {
        $this->SkrimeAPI = $SkrimeAPI;
    }

    /**
     * @param string $nameserver
     * @return array|string
     * @throws GuzzleException
     */
    public function show(string $domainName)
    {
        return $this->SkrimeAPI->get('domain/nameserver', [
            'domain' => $domainName
        ]);
    }

    public function update(string $domainName, array $nameservers)
    {
        return $this->SkrimeAPI->post('domain/nameserver', [
            'domain' => $domainName,
            'nameserver' => $nameservers
        ]);
    }

}