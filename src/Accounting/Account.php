<?php

namespace Skrime\Accounting;

use GuzzleHttp\Exception\GuzzleException;
use Skrime\SkrimeAPI;

class Account
{
    private $SkrimeAPI;

    public function __construct(SkrimeAPI $SkrimeAPI)
    {
        $this->SkrimeAPI = $SkrimeAPI;
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function getBalance()
    {
        return $this->SkrimeAPI->get('accounting/balance');
    }

}