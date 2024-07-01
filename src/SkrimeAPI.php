<?php

namespace Skrime;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Skrime\Accounting\Account;
use Skrime\Domain\Domain;
use Skrime\Exception\ParameterException;
use Skrime\Network\Network;
use Skrime\Plesk\Plesk;

class SkrimeAPI
{
    private $httpClient;
    private $credentials;
    private $apiToken;
    private $pleskHandler;
    private $networkHandler;

    /**
     * SkrimeAPI constructor.
     *
     * @param string    $token      API Token for all requests
     * @param null      $httpClient
     */
    public function __construct(
        string $token,
        $httpClient = null
    ) {
        $this->apiToken = $token;
        $this->setHttpClient($httpClient);
        $this->setCredentials($token);
    }

    /**
     * @param $httpClient Client|null
     */
    public function setHttpClient(Client $httpClient = null)
    {
        $this->httpClient = $httpClient ?: new Client([
            'http_errors' => false,
            'headers'     => [
                'Accept'       => 'application/json',
                'Content-Type' => 'application/json',
                'User-Agent' => 'SkrimeAPI/1.0',
                'Authorization' => 'Bearer ' . $this->apiToken,
            ],
            'allow_redirects' => false,
            'follow_redirects' => false,
            'timeout' => 120,
        ]);
    }

    public function setCredentials($credentials)
    {
        if (!$credentials instanceof Credentials) {
            $credentials = new Credentials($credentials);
        }

        $this->credentials = $credentials;
    }

    /**
     * @return Client
     */
    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->apiToken;
    }

    /**
     * @return Credentials
     */
    private function getCredentials(): Credentials
    {
        return $this->credentials;
    }

    /**
     * @param string    $actionPath The resource path you want to request, see more at the documentation.
     * @param array     $params     Array filled with request params
     * @param string    $method     HTTP method used in the request
     *
     * @return ResponseInterface
     * @throws GuzzleException
     *
     * @throws ParameterException If the given field in params is not an array
     */
    private function request(string $actionPath, array $params = [], string $method = 'GET'): ResponseInterface
    {
        $url = $this->getCredentials()->getUrl() . $actionPath;

        if (!is_array($params)) {
            throw new ParameterException();
        }

        switch ($method) {
            case 'GET':
                return $this->getHttpClient()->get($url, [
                    'verify' => false,
                    'query'  => $params,
                ]);
            case 'POST':
                return $this->getHttpClient()->post($url, [
                    'verify' => false,
                    'json'   => $params,
                ]);
            default:
                throw new ParameterException('Wrong HTTP method passed');
        }
    }

    /**
     * @param $response ResponseInterface
     *
     * @return array|string
     */
    private function processRequest(ResponseInterface $response)
    {
        $response = $response->getBody()->__toString();
        $result = json_decode($response);
        if (json_last_error() == JSON_ERROR_NONE) {
            return $result;
        } else {
            return $response;
        }
    }

    /**
     * @throws GuzzleException
     */
    public function post($actionPath, $params = [])
    {
        $response = $this->request($actionPath, $params, 'POST');

        return $this->processRequest($response);
    }

    /**
     * @throws GuzzleException
     */
    public function get($actionPath, $params = [])
    {
        $response = $this->request($actionPath, $params, 'GET');

        return $this->processRequest($response);
    }


    private $domainHandler;
    private $accountingHandler;

    /**
     * @return Account
     */
    public function accounting(): Account
    {
        if(!$this->accountingHandler) $this->accountingHandler = new Account($this);
        return $this->accountingHandler;
    }

    /**
     * @return Domain
     */
    public function domain(): Domain
    {
        if(!$this->domainHandler) $this->domainHandler = new Domain($this);
        return $this->domainHandler;
    }

    /**
     * @return Plesk
     */
    public function plesk(): Plesk
    {
        if(!$this->pleskHandler) $this->pleskHandler = new Plesk($this);
        return $this->pleskHandler;
    }

    /**
     * @return Network
     */
    public function network(): Network
    {
        if(!$this->networkHandler) $this->networkHandler = new Network($this);
        return $this->networkHandler;
    }

}
