<?php


namespace Ideneal\EmailOctopus\Serializer;


use Psr\Http\Message\ResponseInterface;

abstract class ApiResponseDeserializer extends JsonDeserializer implements ResponseDeserializerInterface
{
    public static function deserialize(ResponseInterface $response)
    {
        $json = json_decode($response->getBody(), true);
        return isset($json['data']) && isset($json['paging']) ? static::deserializeArray($json['data']) : static::deserializeObject($json);
    }
}