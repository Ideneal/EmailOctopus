<?php


namespace Ideneal\EmailOctopus\Serializer;


abstract class JsonDeserializer
{
    abstract public static function deserializeObject(array $json);

    public static function deserializeArray(array $json): array
    {
        $items = [];
        foreach ($json as $item) {
            $items[] = static::deserializeObject($item);
        }
        return $items;
    }
}