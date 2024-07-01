<?php

namespace SKRIME\Accounting;

use GuzzleHttp\Exception\GuzzleException;
use SKRIME\API;

class Account
{
    private $API;

    public function __construct(API $API)
    {
        $this->API = $API;
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function getBalance()
    {
        return $this->API->get('accounting/balance');
    }

}