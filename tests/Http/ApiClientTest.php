<?php
declare(strict_types=1);

namespace Ideneal\EmailOctopus\Tests\Http;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Ideneal\EmailOctopus\Exception\InvalidApiKeyException;
use Ideneal\EmailOctopus\Exception\InvalidParametersException;
use Ideneal\EmailOctopus\Exception\ResourceNotFoundException;
use Ideneal\EmailOctopus\Exception\UnauthorisedException;
use Ideneal\EmailOctopus\Http\ApiClient;
use PHPUnit\Framework\TestCase;

final class ApiClientTest extends TestCase
{
    public function testGetSuccess(): void
    {
        // Mock the HTTP response for a successful GET request
        $responseBody = json_encode(['data' => 'Some data']);
        $response = new Response(200, [], $responseBody);

        // Create a mock handler and set the response
        $mockHandler = new MockHandler([$response]);

        // Create a handler stack with the mock handler
        $handlerStack = HandlerStack::create($mockHandler);

        // Create an instance of ApiClient with the mock handler
        $apiKey = 'your_api_key';
        $apiClient = new ApiClient($apiKey, ['handler' => $handlerStack]);

        // Perform the GET request
        $path = '/some-endpoint';
        $params = ['param1' => 'value1'];
        $result = $apiClient->get($path, $params);

        // Assert the response
        $this->assertEquals($responseBody, $result->getBody()->getContents());
    }

    public function testPostSuccess(): void
    {
        // Mock the HTTP response for a successful POST request
        $responseBody = json_encode(['data' => 'response_data']);
        $response = new Response(200, [], $responseBody);

        // Create a mock handler and set the response
        $mockHandler = new MockHandler([$response]);

        // Create a handler stack with the mock handler
        $handlerStack = HandlerStack::create($mockHandler);

        // Create an instance of ApiClient with the mock handler
        $apiKey = 'valid_api_key';
        $apiClient = new ApiClient($apiKey, ['handler' => $handlerStack]);

        $path = '/some-endpoint';
        $data = ['param1' => 'value1'];
        $params = ['param2' => 'value2'];

        // Perform the POST request
        $response = $apiClient->post($path, $data, $params);

        // Assert the response status code and data
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['data' => 'response_data'], json_decode($response->getBody()->getContents(), true));
    }

    public function testPutSuccess(): void
    {
        // Mock the HTTP response for a successful PUT request
        $responseBody = json_encode(['data' => 'response_data']);
        $response = new Response(200, [], $responseBody);

        // Create a mock handler and set the response
        $mockHandler = new MockHandler([$response]);

        // Create a handler stack with the mock handler
        $handlerStack = HandlerStack::create($mockHandler);

        // Create an instance of ApiClient with the mock handler
        $apiKey = 'valid_api_key';
        $apiClient = new ApiClient($apiKey, ['handler' => $handlerStack]);

        $path = '/some-endpoint';
        $data = ['param1' => 'value1'];
        $params = ['param2' => 'value2'];

        // Perform the PUT request
        $response = $apiClient->put($path, $data, $params);
        // Assert the response status code and data
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['data' => 'response_data'], json_decode($response->getBody()->getContents(), true));
    }

    public function testDeleteSuccess(): void
    {
        // Mock the HTTP response for a successful DELETE request
        $responseBody = json_encode(['data' => 'response_data']);
        $response = new Response(200, [], $responseBody);

        // Create a mock handler and set the response
        $mockHandler = new MockHandler([$response]);

        // Create a handler stack with the mock handler
        $handlerStack = HandlerStack::create($mockHandler);

        // Create an instance of ApiClient with the mock handler
        $apiKey = 'valid_api_key';
        $apiClient = new ApiClient($apiKey, ['handler' => $handlerStack]);

        $path = '/some-endpoint';
        $params = ['param1' => 'value1'];

        // Perform the DELETE request
        $response = $apiClient->delete($path, $params);

        // Assert the response status code and data
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['data' => 'response_data'], json_decode($response->getBody()->getContents(), true));
    }

        public function testInvalidApiKeyException(): void
    {
        // Mock the HTTP response for an invalid API key error
        $responseBody = json_encode(['error' => ['code' => 'API_KEY_INVALID', 'message' => 'Invalid API key']]);
        $response = new Response(401, [], $responseBody);

        // Create a mock handler and set the response
        $mockHandler = new MockHandler([$response]);

        // Create a handler stack with the mock handler
        $handlerStack = HandlerStack::create($mockHandler);

        // Create an instance of ApiClient with the mock handler
        $apiKey = 'invalid_api_key';
        $apiClient = new ApiClient($apiKey, ['handler' => $handlerStack]);

        // Perform the GET request and expect an InvalidApiKeyException to be thrown
        $this->expectException(InvalidApiKeyException::class);

        $path = '/some-endpoint';
        $params = ['param1' => 'value1'];
        $apiClient->get($path, $params);
    }

    public function testInvalidParametersException(): void
    {
        // Mock the HTTP response for an invalid parameters error
        $responseBody = json_encode(['error' => ['code' => 'INVALID_PARAMETERS', 'message' => 'Invalid parameters']]);
        $response = new Response(400, [], $responseBody);

        // Create a mock handler and set the response
        $mockHandler = new MockHandler([$response]);

        // Create a handler stack with the mock handler
        $handlerStack = HandlerStack::create($mockHandler);

        // Create an instance of ApiClient with the mock handler
        $apiKey = 'valid_api_key';
        $apiClient = new ApiClient($apiKey, ['handler' => $handlerStack]);

        // Perform the GET request and expect an InvalidParametersException to be thrown
        $this->expectException(InvalidParametersException::class);

        $path = '/some-endpoint';
        $params = ['param1' => 'value1'];
        $apiClient->get($path, $params);
    }

    public function testUnauthorisedException(): void
    {
        // Mock the HTTP response for an unauthorized error
        $responseBody = json_encode(['error' => ['code' => 'UNAUTHORISED', 'message' => 'Unauthorized']]);
        $response = new Response(401, [], $responseBody);

        // Create a mock handler and set the response
        $mockHandler = new MockHandler([$response]);

        // Create a handler stack with the mock handler
        $handlerStack = HandlerStack::create($mockHandler);

        // Create an instance of ApiClient with the mock handler
        $apiKey = 'valid_api_key';
        $apiClient = new ApiClient($apiKey, ['handler' => $handlerStack]);

        // Perform the GET request and expect an UnauthorisedException to be thrown
        $this->expectException(UnauthorisedException::class);

        $path = '/some-endpoint';
        $params = ['param1' => 'value1'];
        $apiClient->get($path, $params);
    }

    public function testResourceNotFoundException(): void
    {
        // Mock the HTTP response for a resource not found error
        $responseBody = json_encode(['error' => ['code' => 'NOT_FOUND', 'message' => 'Resource not found']]);
        $response = new Response(404, [], $responseBody);

        // Create a mock handler and set the response
        $mockHandler = new MockHandler([$response]);

        // Create a handler stack with the mock handler
        $handlerStack = HandlerStack::create($mockHandler);

        // Create an instance of ApiClient with the mock handler
        $apiKey = 'valid_api_key';
        $apiClient = new ApiClient($apiKey, ['handler' => $handlerStack]);

        // Perform the GET request and expect a ResourceNotFoundException to be thrown
        $this->expectException(ResourceNotFoundException::class);

        $path = '/some-endpoint';
        $params = ['param1' => 'value1'];
        $apiClient->get($path, $params);
    }
}
