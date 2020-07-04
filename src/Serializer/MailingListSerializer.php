<?php


namespace Ideneal\EmailOctopus\Serializer;


use Ideneal\EmailOctopus\Entity\MailingList;

class MailingListSerializer extends ApiSerializer
{
    /**
     * @param array $json
     *
     * @return MailingList
     *
     * @throws \Exception
     */
    public static function deserializeObject(array $json)
    {
        $mailingList = new MailingList();
        $mailingList
            ->setId($json['id'])
            ->setName($json['name'])
            ->setCreatedAt(new \DateTime($json['created_at']))
        ;

        if (isset($json['double_opt_in'])) {
            $mailingList->setDoubleOptIn($json['double_opt_in']);
        }

        if (isset($json['fields'])) {
            $mailingList->setFields($json['fields']);
        }

        if (isset($json['counts'])) {
            $mailingList->setCounts($json['counts']);
        }

        return $mailingList;
    }

    /**
     * @param MailingList $object
     *
     * @return array
     */
    public static function serialize($object): array
    {
        return [
            'name' => $object->getName(),
        ];
    }
}