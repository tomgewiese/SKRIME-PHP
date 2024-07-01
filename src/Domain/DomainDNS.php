<?php

namespace Skrime\Domain;

use GuzzleHttp\Exception\GuzzleException;
use Skrime\SkrimeAPI;

class DomainDNS
{
    private $SkrimeAPI;

    public function __construct(SkrimeAPI $SkrimeAPI)
    {
        $this->SkrimeAPI = $SkrimeAPI;
    }

    /**
     * @param string $domainName
     * @return array|string
     * @throws GuzzleException
     */
    public function get(string $domainName)
    {
        return $this->SkrimeAPI->get('domain/dns', [
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
        return $this->SkrimeAPI->post('domain/dns', [
            'domain' => $domainName,
            'records' => $records
        ]);
    }

}