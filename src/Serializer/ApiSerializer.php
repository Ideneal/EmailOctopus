<?php
declare(strict_types=1);

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
 * Class ApiSerializer
 *
 * @package Ideneal\EmailOctopus\Serializer
 */
abstract class ApiSerializer extends JsonDeserializer implements ApiSerializerInterface
{
    /**
     * @param ResponseInterface $response
     *
     * @return array|object
     */
    public static function deserialize(ResponseInterface $response)
    {
        $json = json_decode($response->getBody(), true);
        return isset($json['data']) && isset($json['paging']) ? static::deserializeMultiple($json['data']) : static::deserializeSingle($json);
    }
}