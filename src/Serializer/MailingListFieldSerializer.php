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

use Ideneal\EmailOctopus\Entity\MailingListField;

/**
 * Class MailingListFieldSerializer
 *
 * @package Ideneal\EmailOctopus\Serializer
 */
class MailingListFieldSerializer extends ApiSerializer
{
    /**
     * @param MailingListField $object
     *
     * @return array<string, string>
     */
    public static function serialize($object): array
    {
        if (!$object instanceof MailingListField) {
            throw new \InvalidArgumentException('Invalid object type. Expected MailingListField.');
        }

        return [
            'label'    => $object->getLabel(),
            'tag'      => $object->getTag(),
            'type'     => $object->getType(),
            'fallback' => $object->getFallback(),
        ];
    }

    /**
     * @param array<string, string> $json
     */
    public static function deserializeSingle(array $json): MailingListField
    {
        $field = new MailingListField();
        $field
            ->setLabel($json['label'])
            ->setTag($json['tag'])
            ->setType($json['type'])
            ->setFallback($json['fallback'])
        ;

        return $field;
    }
}