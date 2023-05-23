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
     * @param array $json
     *
     * @return object
     */
    abstract public static function deserializeSingle(array $json);

    /**
     * Deserializes a json array into an object array.
     *
     * @param array $jsonArray
     *
     * @return array
     */
    public static function deserializeMultiple(array $jsonArray): array
    {
        $items = [];
        foreach ($jsonArray as $jsonItem) {
            $items[] = static::deserializeSingle($jsonItem);
        }
        return $items;
    }
}