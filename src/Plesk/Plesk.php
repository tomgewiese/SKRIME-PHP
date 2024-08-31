<?php

namespace SKRIME\Plesk;

use GuzzleHttp\Exception\GuzzleException;
use SKRIME\API;

class Plesk
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
    public function getAll()
    {
        return $this->API->get('plesk/all');
    }

    /**
     * @param string $productId
     * @return array|string
     * @throws GuzzleException
     */
    public function getSingle(string $productId)
    {
        return $this->API->get('plesk/single', [
            'productId' => $productId
        ]);
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function getPriceList()
    {
        return $this->API->get('plesk/pricelist');
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
        return $this->API->post('plesk/order', [
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
        return $this->API->post('plesk/renew', [
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
        return $this->API->get('plesk/binding', [
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
        return $this->API->post('plesk/binding', [
            'productId' => $productId,
            'ipAddress' => $ipAddress
        ]);
    }
}