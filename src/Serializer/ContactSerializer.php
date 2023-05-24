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

use Ideneal\EmailOctopus\Entity\Contact;

/**
 * Class ContactSerializer
 *
 * @package Ideneal\EmailOctopus\Serializer
 */
class ContactSerializer extends ApiSerializer
{
    /**
     * @param array<string, mixed> $json
     *
     * @throws \Exception
     */
    public static function deserializeSingle(array $json): Contact
    {
        $contact = new Contact();
        $contact
            ->setId($json['id'])
            ->setEmail($json['email_address'])
            ->setFields($json['fields'])
            ->setStatus($json['status'])
            ->setCreatedAt(new \DateTime($json['created_at']))
        ;

        return $contact;
    }

    /**
     * @param Contact $object
     *
     * @return array<string, mixed>
     */
    public static function serialize($object): array
    {
        if (!$object instanceof Contact) {
            throw new \InvalidArgumentException('Invalid object type. Expected Contact.');
        }

        $json = [
            'email_address' => $object->getEmail(),
            'fields'        => $object->getFields(),
        ];

        if ($object->getStatus()) {
            $json['status'] = $object->getStatus();
        }

        return $json;
    }
}