<?php

namespace SKRIME\Domain;

use GuzzleHttp\Exception\GuzzleException;
use SKRIME\API;

class Domain
{
    private $API;
    private $nameserverHandler;
    private $domainDNS;
    private $domainContact;

    public function __construct(API $API)
    {
        $this->API = $API;
    }

    /**
     * @return Nameserver
     */
    public function nameserver(): Nameserver
    {
        if(!$this->nameserverHandler) $this->nameserverHandler = new Nameserver($this->API);
        return $this->nameserverHandler;
    }

    /**
     * @return DomainDNS
     */
    public function dns(): DomainDNS
    {
        if(!$this->domainDNS) $this->domainDNS = new DomainDNS($this->API);
        return $this->domainDNS;
    }

    /**
     * @return DomainContact
     */
    public function contact(): DomainContact
    {
        if(!$this->domainContact) $this->domainContact = new DomainContact($this->API);
        return $this->domainContact;
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function getPricelist()
    {
        return $this->API->get('domain/pricelist');
    }

    /**
     * @param string $domainName    domain.de
     * @return array|string
     * @throws GuzzleException
     */
    public function check(string $domainName)
    {
        return $this->API->post('domain/check', [
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
        return $this->API->get('domain/single', [
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
        return $this->API->get('domain/all');
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
    public function register(string $domainName, string $firstname, string $lastname, string $street, string $number, string $postcode, string $city, string $state, string $country, string $email, string $phone, string $company = null, bool $tos = false, bool $cancellation = false, array $nameserver = [])
    {
        return $this->API->post('domain/order', [
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
            "nameserver" => $nameserver,
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
    public function transfer(string $domainName, string $authcode, string $firstname, string $lastname, string $street, string $number, string $postcode, string $city, string $state, string $country, string $email, string $phone, string $company = null, bool $tos = false, bool $cancellation = false, array $nameserver = [])
    {
        return $this->API->post('domain/order', [
            'domain' => $domainName,
            'authCode' => $authcode,
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
            "nameserver" => $nameserver,
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
        return $this->API->post('domain/renew', [
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
        return $this->API->get('domain/authcode', [
            'domain' => $domainName
        ]);
    }

}