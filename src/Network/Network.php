<?php

namespace SKRIME\Network;

use GuzzleHttp\Exception\GuzzleException;
use SKRIME\API;

class Network
{
    private $API;

    public function __construct(API $API)
    {
        $this->API = $API;
    }

    /**
     * @param string $hostname
     * @param string $username
     * @param string $password
     * @param string $realm
     * @return array|string
     * @throws GuzzleException
     */
    public function getNoVNC(string $hostname, string $username, string $password, string $realm = "pam")
    {
        return $this->API->post('server/novnc', [
            'hostname' => $hostname,
            'username' => $username,
            'password' => $password,
            'realm' => $realm
        ]);
    }

    /**
     * @param string $ipAddress
     * @return array|string
     * @throws GuzzleException
     */
    public function getRdns(string $ipAddress)
    {
        return $this->API->get('server/rdns', [
            'ipAddress' => $ipAddress
        ]);
    }

    /**
     * @param string $ipAddress
     * @param string $domain
     * @return array|string
     * @throws GuzzleException
     */
    public function setRdns(string $ipAddress, string $domain)
    {
        return $this->API->post('server/rdns', [
            'ipAddress' => $ipAddress,
            'rdns' => $domain
        ]);
    }
}