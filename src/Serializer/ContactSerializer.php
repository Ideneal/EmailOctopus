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
     * @param array $json
     *
     * @return Contact
     *
     * @throws \Exception
     */
    public static function deserializeSingle(array $json)
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
     * @return array
     */
    public static function serialize($object): array
    {
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