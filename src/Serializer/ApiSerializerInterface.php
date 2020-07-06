<?php
/*
 * This file is part of the ideneal/emailoctopus library
 *
 * (c) Daniele Pedone <ideneal.ztl@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ideneal\EmailOctopus\Serializer;


use Psr\Http\Message\ResponseInterface;

/**
 * Interface ApiSerializerInterface
 *
 * @package Ideneal\EmailOctopus\Serializer
 */
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