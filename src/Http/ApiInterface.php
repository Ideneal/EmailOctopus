<?php


namespace Ideneal\EmailOctopus\Http;


use Psr\Http\Message\ResponseInterface;

interface ApiInterface
{
    public function get(string $path, array $params = []): ResponseInterface;

    public function post(string $path, array $params = [], array $data = []): ResponseInterface;

    public function put(string $path, array $params = [], array $data = []): ResponseInterface;

    public function delete(string $path, array $params = []): ResponseInterface;
}