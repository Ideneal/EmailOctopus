<?php
declare(strict_types=1);

namespace Ideneal\EmailOctopus\Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Ideneal\EmailOctopus\EmailOctopus;
use Ideneal\EmailOctopus\Entity\Automation;
use Ideneal\EmailOctopus\Http\ApiClient;
use PHPUnit\Framework\TestCase;

final class EmailOctopusTest extends TestCase
{
    public function testStartAutomationSuccess(): void
    {
        // Mock the HTTP response for a successful POST request
        $response = new Response(200);

        // Create a mock handler and set the response
        $mockHandler = new MockHandler([$response]);

        // Create a handler stack with the mock handler
        $handlerStack = HandlerStack::create($mockHandler);

        // Create an instance of EmailOctopus with the mock client
        $apiKey = 'valid_api_key';
        $emailOctopus = new EmailOctopus($apiKey);
        $emailOctopus->setApiClient(new ApiClient($apiKey, ['handler' => $handlerStack]));

        // Create a mock Automation object
        $automation = new Automation();
        $automation->setId('automation_id');

        // Perform the startAutomation request
        $emailOctopus->startAutomation($automation);

        // Assert that the POST request was sent to the correct endpoint
        $request = $mockHandler->getLastRequest();
        $this->assertEquals('POST', $request->getMethod());
        $this->assertEquals('/api/1.6/automations/automation_id/queue', $request->getUri()->getPath());
    }
}