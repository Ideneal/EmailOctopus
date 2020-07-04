<?php


namespace Ideneal\EmailOctopus\Http;


use GuzzleHttp\Client;
use Ideneal\EmailOctopus\Exception\InvalidApiKeyException;
use Ideneal\EmailOctopus\Exception\InvalidParametersException;
use Ideneal\EmailOctopus\Exception\ResourceNotFoundException;
use Ideneal\EmailOctopus\Exception\UnauthorisedException;
use Psr\Http\Message\ResponseInterface;


class ApiClient implements ApiInterface
{
    const BASE_URL    = 'https://emailoctopus.com/api';
    const API_VERSION = '1.5';

    private $apiKey;

    private $client;

    public function __construct(string $apiKey, array $config = [])
    {
        $this->apiKey = $apiKey;

        $this->client = new Client([
            'base_uri'    => self::BASE_URL . '/' . self::API_VERSION . '/',
            'http_errors' => false,
        ]);
    }


    public function get(string $path, array $params = []): ResponseInterface
    {
        $response = $this->client->get($path, [
            'query' => $this->processQuery($params),
        ]);

        $this->validateResponse($response);

        return $response;
    }

    public function post(string $path, array $params = [], array $data = []): ResponseInterface
    {
        $response = $this->client->post($path, [
            'query' => $this->processQuery($params),
            'json'  => $data,
        ]);

        $this->validateResponse($response);

        return $response;
    }

    public function put(string $path, array $params = [], array $data = []): ResponseInterface
    {
        $response = $this->client->put($path, [
            'query' => $this->processQuery($params),
            'json'  => $data,
        ]);

        $this->validateResponse($response);

        return $response;
    }

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
     * @throws \HttpException
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
                    throw new \HttpException($message);
            }
        }
    }
}