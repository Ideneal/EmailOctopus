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

/**
 * Class JsonDeserializer
 *
 * @package Ideneal\EmailOctopus\Serializer
 */
abstract class JsonDeserializer
{
    /**
     * Deserializes a json into an object.
     *
     * @param array<string, string> $json
     *
     * @return mixed
     */
    abstract public static function deserializeSingle(array $json);

    /**
     * Deserializes a json array into an object array.
     *
     * @param array<int, array<string, string>> $jsonArray
     *
     * @return array<int, mixed>
     */
    public static function deserializeMultiple(array $jsonArray): array
    {
        return \array_map(fn (array $json) => static::deserializeSingle($json), $jsonArray);
    }
}