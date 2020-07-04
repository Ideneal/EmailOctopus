<?php


namespace Ideneal\EmailOctopus\Serializer;


use Psr\Http\Message\ResponseInterface;

interface ResponseDeserializerInterface
{
    public static function deserialize(ResponseInterface $response);
}