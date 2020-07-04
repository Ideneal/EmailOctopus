<?php


namespace Ideneal\EmailOctopus\Serializer;


use Psr\Http\Message\ResponseInterface;

interface ApiSerializerInterface
{
    /**
     * Deserialize a response into an object or array of objects.
     *
     * @param ResponseInterface $response
     *
     * @return array|object
     */
    public static function deserialize(ResponseInterface $response);

    /**
     * Serialize an object into a json.
     *
     * @param object $object
     *
     * @return array
     */
    public static function serialize($object): array;
}