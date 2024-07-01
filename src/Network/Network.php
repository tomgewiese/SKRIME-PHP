<?php

namespace Skrime\Network;

use GuzzleHttp\Exception\GuzzleException;
use Skrime\SkrimeAPI;

class Network
{
    private $SkrimeAPI;

    public function __construct(SkrimeAPI $SkrimeAPI)
    {
        $this->SkrimeAPI = $SkrimeAPI;
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
        return $this->SkrimeAPI->post('server/novnc', [
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
        return $this->SkrimeAPI->get('server/rdns', [
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
        return $this->SkrimeAPI->post('server/rdns', [
            'ipAddress' => $ipAddress,
            'rdns' => $domain
        ]);
    }
}