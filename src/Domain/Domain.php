<?php

namespace Skrime\Domain;

use GuzzleHttp\Exception\GuzzleException;
use Skrime\SkrimeAPI;

class Domain
{
    private $SkrimeAPI;
    private $nameserverHandler;
    private $domainDNS;
    public function __construct(SkrimeAPI $SkrimeAPI)
    {
        $this->SkrimeAPI = $SkrimeAPI;
    }

    /**
     * @return Nameserver
     */
    public function nameserver(): Nameserver
    {
        if(!$this->nameserverHandler) $this->nameserverHandler = new Nameserver($this->SkrimeAPI);
        return $this->nameserverHandler;
    }

    /**
     * @return DomainDNS
     */
    public function dns(): DomainDNS
    {
        if(!$this->domainDNS) $this->domainDNS = new DomainDNS($this->SkrimeAPI);
        return $this->domainDNS;
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function getPricelist()
    {
        return $this->SkrimeAPI->post('domain/pricelist');
    }

    /**
     * @param string $domainName    domain.de
     * @return array|string
     * @throws GuzzleException
     */
    public function check(string $domainName)
    {
        return $this->SkrimeAPI->post('domain/check', [
            'domain' => $domainName
        ]);
    }

    /**
     * @param string $domainName    domain.de
     * @return array|string
     * @throws GuzzleException
     */
    public function get(string $domainName)
    {
        return $this->SkrimeAPI->post('domain/single', [
            'domain' => $domainName
        ]);
    }

    /**
     * @param string $domainName    domain.de
     * @return array|string
     * @throws GuzzleException
     */
    public function getAll()
    {
        return $this->SkrimeAPI->post('domain/all');
    }

    /**
     * @param string $domainName domain.de
     * @param string $firstname
     * @param string $lastname
     * @param string $street
     * @param string $number
     * @param string $postcode
     * @param string $city
     * @param string $state
     * @param string $country
     * @param string $email
     * @param string $phone
     * @param string|null $company
     * @param bool $tos
     * @param bool $cancellation
     * @return array|string
     * @throws GuzzleException
     */
    public function register(string $domainName, string $firstname, string $lastname, string $street, string $number, string $postcode, string $city, string $state, string $country, string $email, string $phone, string $company = null, bool $tos = false, bool $cancellation = false)
    {
        return $this->SkrimeAPI->post('domain/order', [
            'domain' => $domainName,
            'contact' => [
                "company" => $company,
                "firstname" => $firstname,
                "lastname" => $lastname,
                "street" => $street,
                "number" => $number,
                "postcode" => $postcode,
                "city" => $city,
                "state" => $state,
                "country" => $country,
                "email" => $email,
                "phone" => $phone
            ],
            "tos" => $tos,
            "cancellation" => $cancellation,
        ]);
    }

    /**
     * @param string $domainName domain.de
     * @param string $authcode
     * @param string $firstname
     * @param string $lastname
     * @param string $street
     * @param string $number
     * @param string $postcode
     * @param string $city
     * @param string $state
     * @param string $country
     * @param string $email
     * @param string $phone
     * @param string|null $company
     * @param bool $tos
     * @param bool $cancellation
     * @return array|string
     * @throws GuzzleException
     */
    public function transfer(string $domainName, string $authcode, string $firstname, string $lastname, string $street, string $number, string $postcode, string $city, string $state, string $country, string $email, string $phone, string $company = null, bool $tos = false, bool $cancellation = false)
    {
        return $this->SkrimeAPI->post('domain/order', [
            'domain' => $domainName,
            'authcode' => $authcode,
            'contact' => [
                "company" => $company,
                "firstname" => $firstname,
                "lastname" => $lastname,
                "street" => $street,
                "number" => $number,
                "postcode" => $postcode,
                "city" => $city,
                "state" => $state,
                "country" => $country,
                "email" => $email,
                "phone" => $phone
            ],
            "tos" => $tos,
            "cancellation" => $cancellation,
        ]);
    }

    /**
     * @param string $domainName    domain.de
     * @return array|string
     * @throws GuzzleException
     */
    public function renew(string $domainName)
    {
        return $this->SkrimeAPI->post('domain/renew', [
            'domain' => $domainName
        ]);
    }

    /**
     * @param string $domainName    domain.de
     * @return array|string
     * @throws GuzzleException
     */
    public function getAuthInfo(string $domainName)
    {
        return $this->SkrimeAPI->get('domain/authcode', [
            'domain' => $domainName
        ]);
    }

}