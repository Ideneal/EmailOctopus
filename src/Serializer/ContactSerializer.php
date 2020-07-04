<?php


namespace Ideneal\EmailOctopus\Serializer;


use Ideneal\EmailOctopus\Entity\Contact;

class ContactSerializer extends ApiSerializer
{
    /**
     * @param array $json
     *
     * @return Contact
     *
     * @throws \Exception
     */
    public static function deserializeObject(array $json)
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