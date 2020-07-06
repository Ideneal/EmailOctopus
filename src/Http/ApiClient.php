<?php
/*
 * This file is part of the ideneal/emailoctopus library
 *
 * (c) Daniele Pedone <ideneal.ztl@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Ideneal\EmailOctopus\Http;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Ideneal\EmailOctopus\Exception\InvalidApiKeyException;
use Ideneal\EmailOctopus\Exception\InvalidParametersException;
use Ideneal\EmailOctopus\Exception\ResourceNotFoundException;
use Ideneal\EmailOctopus\Exception\UnauthorisedException;
use Psr\Http\Message\ResponseInterface;


/**
 * Class ApiClient
 *
 * @package Ideneal\EmailOctopus\Http
 */
class ApiClient implements ApiInterface
{
    const BASE_URL    = 'https://emailoctopus.com/api';
    const API_VERSION = '1.5';

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var Client
     */
    private $client;

    /**
     * ApiClient constructor.
     *
     * @param string $apiKey
     * @param array  $config
     */
    public function __construct(string $apiKey, array $config = [])
    {
        $this->apiKey = $apiKey;

        $this->client = new Client([
            'base_uri'    => self::BASE_URL . '/' . self::API_VERSION . '/',
            'http_errors' => false,
        ]);
    }

    /**
     * @param string $path
     * @param array  $params
     *
     * @return ResponseInterface
     * @throws InvalidApiKeyException
     * @throws InvalidParametersException
     * @throws ResourceNotFoundException
     * @throws UnauthorisedException
     * @throws GuzzleException
     */
    public function get(string $path, array $params = []): ResponseInterface
    {
        $response = $this->client->get($path, [
            'query' => $this->processQuery($params),
        ]);

        $this->validateResponse($response);

        return $response;
    }

    /**
     * @param string $path
     * @param array  $data
     * @param array  $params
     *
     * @return ResponseInterface
     * @throws InvalidApiKeyException
     * @throws InvalidParametersException
     * @throws ResourceNotFoundException
     * @throws UnauthorisedException
     * @throws GuzzleException
     */
    public function post(string $path, array $data = [], array $params = []): ResponseInterface
    {
        $response = $this->client->post($path, [
            'query' => $this->processQuery($params),
            'json'  => $data,
        ]);

        $this->validateResponse($response);

        return $response;
    }

    /**
     * @param string $path
     * @param array  $data
     * @param array  $params
     *
     * @return ResponseInterface
     * @throws InvalidApiKeyException
     * @throws InvalidParametersException
     * @throws ResourceNotFoundException
     * @throws UnauthorisedException
     * @throws GuzzleException
     */
    public function put(string $path, array $data = [], array $params = []): ResponseInterface
    {
        $response = $this->client->put($path, [
            'query' => $this->processQuery($params),
            'json'  => $data,
        ]);

        $this->validateResponse($response);

        return $response;
    }

    /**
     * @param string $path
     * @param array  $params
     *
     * @return ResponseInterface
     * @throws InvalidApiKeyException
     * @throws InvalidParametersException
     * @throws ResourceNotFoundException
     * @throws UnauthorisedException
     * @throws GuzzleException
     */
    public function delete(string $path, array $params = []): ResponseInterface
    {
        $response = $this->client->post($path, [
            'query' => $this->processQuery($params),
        ]);

        $this->validateResponse($response);

        return $response;
    }

    /**
     * Process the request query before send it.
     *
     * @param array $params
     *
     * @return array
     */
    private function processQuery(array $params = []): array
    {
        return array_merge($params, [
            'api_key' => $this->apiKey,
        ]);
    }

    /**
     * Validates the response.
     *
     * @param ResponseInterface $response
     *
     * @throws InvalidApiKeyException
     * @throws InvalidParametersException
     * @throws ResourceNotFoundException
     * @throws UnauthorisedException
     * @throws \Exception
     */
    private function validateResponse(ResponseInterface $response)
    {
        if ($response->getStatusCode() !== 200) {
            $json    = json_decode($response->getBody(), true);
            $error   = $json['error'];
            $code    = $error['code'];
            $message = $error['message'];

            switch ($code) {
                case 'INVALID_PARAMETERS':
                    throw new InvalidParametersException($message);
                case 'API_KEY_INVALID':
                    throw new InvalidApiKeyException($message);
                case 'UNAUTHORISED':
                    throw new UnauthorisedException($message);
                case 'NOT_FOUND':
                    throw new ResourceNotFoundException($message);
                default:
                    throw new \Exception($message);
            }
        }
    }
}