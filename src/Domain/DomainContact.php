<?php

namespace SKRIME\Domain;

use GuzzleHttp\Exception\GuzzleException;
use SKRIME\API;

class DomainContact
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
        return $this->API->get('domain/contact', [
            'domain' => $domainName
        ]);
    }

    /**
     * @param string $domainName
     * @param array $records
     * @return array|string
     * @throws GuzzleException
     */
    public function update(string $domainName, array $contact)
    {
        return $this->API->post('domain/contact', [
            'domain' => $domainName,
            'contact' => $contact
        ]);
    }

}