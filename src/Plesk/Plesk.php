<?php

namespace Skrime\Plesk;

use GuzzleHttp\Exception\GuzzleException;
use Skrime\SkrimeAPI;

class Plesk
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
    public function getAll()
    {
        return $this->SkrimeAPI->get('plesk/all');
    }

    /**
     * @param string $productId
     * @return array|string
     * @throws GuzzleException
     */
    public function getSingle(string $productId)
    {
        return $this->SkrimeAPI->get('plesk/all', [
            'productId' => $productId
        ]);
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function getPriceList()
    {
        return $this->SkrimeAPI->get('plesk/pricelist');
    }

    /**
     * @param bool $yearly
     * @param bool $tos
     * @param bool $cancellation
     * @return array|string
     * @throws GuzzleException
     */
    public function order(bool $yearly, bool $tos = false, bool $cancellation = false)
    {
        return $this->SkrimeAPI->post('plesk/order', [
            'duration' => $yearly ? 'yearly' : 'monthly',
            'tos' => $tos,
            'cancellation' => $cancellation
        ]);
    }

    /**
     * @param string $productId
     * @return array|string
     * @throws GuzzleException
     */
    public function renew(string $productId)
    {
        return $this->SkrimeAPI->post('plesk/renew', [
            'productId' => $productId
        ]);
    }

    /**
     * @param string $productId
     * @return array|string
     * @throws GuzzleException
     */
    public function getBinding(string $productId)
    {
        return $this->SkrimeAPI->get('plesk/binding', [
            'productId' => $productId
        ]);
    }

    /**
     * @param string $productId
     * @param string $ipAddress
     * @return array|string
     * @throws GuzzleException
     */
    public function setBinding(string $productId, string $ipAddress)
    {
        return $this->SkrimeAPI->post('plesk/binding', [
            'productId' => $productId,
            'ipAddress' => $ipAddress
        ]);
    }
}