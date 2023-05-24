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


use Ideneal\EmailOctopus\Entity\MailingList;


/**
 * Class MailingListSerializer
 *
 * @package Ideneal\EmailOctopus\Serializer
 */
class MailingListSerializer extends ApiSerializer
{
    /**
     * @param array<string, mixed> $json
     *
     * @return MailingList
     *
     * @throws \Exception
     */
    public static function deserializeSingle(array $json): MailingList
    {
        $mailingList = new MailingList();
        $mailingList
            ->setId($json['id'])
            ->setName($json['name'])
            ->setCreatedAt(new \DateTime($json['created_at']))
        ;

        if (isset($json['double_opt_in'])) {
            $mailingList->setDoubleOptIn((bool) $json['double_opt_in']);
        }

        if (isset($json['fields'])) {
            $fields = MailingListFieldSerializer::deserializeMultiple($json['fields']);
            $mailingList->setFields($fields);
        }

        if (isset($json['counts'])) {
            $mailingList->setCounts($json['counts']);
        }

        return $mailingList;
    }

    /**
     * @param MailingList $object
     *
     * @return array<string, string>
     */
    public static function serialize($object): array
    {
        if (!$object instanceof MailingList) {
            throw new \InvalidArgumentException('Invalid object type. Expected MailingList.');
        }

        return [
            'name' => $object->getName(),
        ];
    }
}